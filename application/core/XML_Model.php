<?php

class XML_Model extends Memory_Model
{
//---------------------------------------------------------------------------
//  Housekeeping methods
//---------------------------------------------------------------------------
    protected $_xml;
	/**
	 * Constructor.
	 * @param string $origin Filename of the xml file
	 * @param string $keyfield  Name of the primary key field
	 * @param string $entity	Entity name meaningful to the persistence
	 */
	function __construct()
	{
        $this->_xml = simplexml_load_file('../data/tasks.xml');
        $this->_data = array(); // an array of objects
        $this->_fields = array(); // an array of strings
        $this->_keyfield = 'id';
		$this->load();
	}

	/**
	 * Load the collection state appropriately, depending on persistence choice.
	 * OVER-RIDE THIS METHOD in persistence choice implementations
	 */
	protected function load()
	{
        $data = $this->_xml;
        $allTasks;
        $first = true;
        foreach ($this->_xml as $task)
        {
            if($first)
            {
                foreach($task as $attribute)
                {
                    array_push($this->_fields, $attribute->getName());
                }
                $first = false;
            }
            $record = new stdClass();
            for($i = 0; $i< count($this->_fields); $i++)
            {
                $record->{$this->_fields[$i]} = (string)$task->{$this->_fields[$i]};
            }
            $key = $record->{$this->_keyfield};
            $this->_data[$key] = $record;
        }
		// --------------------
		// rebuild the keys table
		$this->reindex();
	}

	/**
	 * Store the collection state appropriately, depending on persistence choice.
	 * OVER-RIDE THIS METHOD in persistence choice implementations
	 */
	protected function store()
	{
		$data = $this->_data;
		
		$xml = new DOMDocument('1.0', 'utf-8');
		$xml->formatOutput = true;
		$xml->preserveWhiteSpace = false;
		$tasks = $xml->createElement('tasks');

		foreach($data as $record)
		{
			// Creating the xml for each field of task + appending them to a task element
			$taskobj = $xml->createElement('task');
			$id = $xml->createElement('id');
			$id->appendChild($xml->createTextNode(isset($record->{'id'})? $record->{'id'} : ''));
			$taskobj->appendChild($id);

			$task = $xml->createElement('task');
			$task->appendChild($xml->createTextNode(isset($record->{'task'})? $record->{'task'} : ''));
			$taskobj->appendChild($task);

			$priority = $xml->createElement('priority');
			$priority->appendChild($xml->createTextNode(isset($record->{'priority'})? $record->{'priority'} : ''));
			$taskobj->appendChild($priority);

			$size = $xml->createElement('size');
			$size->appendChild($xml->createTextNode(isset($record->{'size'})? $record->{'size'} : ''));
			$taskobj->appendChild($size);

			$group = $xml->createElement('group');
			$group->appendChild($xml->createTextNode(isset($record->{'group'})? $record->{'group'} : ''));
			$taskobj->appendChild($group);

			$deadline = $xml->createElement('deadline');
			$deadline->appendChild($xml->createTextNode(isset($record->{'deadline'})? $record->{'deadline'} : ''));
			$taskobj->appendChild($deadline);

			$status = $xml->createElement('status');
			$status->appendChild($xml->createTextNode(isset($record->{'status'})? $record->{'status'} : ''));
			$taskobj->appendChild($status);

			$flag = $xml->createElement('flag');
			$flag->appendChild($xml->createTextNode(isset($record->{'flag'})? $record->{'flag'} : ''));
			$taskobj->appendChild($flag);
			// Appending the task element to the dom
			$tasks->appendChild($taskobj);
		}

		$xml->appendChild($tasks);
		
		$xml->saveXML($xml);
		//$this->_xml
		$xml->save('../data/tasks.xml');
		
	}

}
