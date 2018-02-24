<?php
namespace DataLayer\CSV\Functions;


class LoadCSVToDataBase{
    public function __construct($addCSVTable, $addCSVEntry){
        $this->setAddCSVTableFunction($addCSVTable);
        $this->setAddCSVEntryFunction($addCSVEntry);
    }

    public function Run(\DataLayer\CSV\Requests\LoadCSVToDataBase $request){
        $data = $request->getFileData();
        $columns = $request->getColumns();
        $tableName = $request->getTableName();

        $strings = explode("\n", $data);
        //clear the empty strings
        foreach($strings as $key => $value){
            if (strlen($value) == 0){
                unset($strings[$key]);
            }
        }


        if (strlen($tableName) == 0){
            throw new \Exceptions\DefaultException("No table name");
        }

        if (!is_array($columns) || count($columns) == 0){
            throw new \Exceptions\DefaultException("No columns");
        }

        if (count($columns) !== count(array_unique($columns))){
            throw new \Exceptions\DefaultException("Duplicates of columns founded");
        }

        $rows = array_slice ($strings, 1);

        //adding columns
        $createColumns = array();
        foreach ($columns as $key => $value){
            $createColumns[] = '`'.strtoupper($value).'` TEXT NOT NULL ';
        }

        $requestAddTable = new \DataLayer\CSV\Requests\AddCSVTable();
        $requestAddTable->setTableName($tableName);
        $requestAddTable->setColumns($createColumns);

        $this->getAddCSVTableFunction()->Run($requestAddTable);

        $addEntryRequest = new \DataLayer\CSV\Requests\AddCSVEntry();
        $addEntryRequest->setTableName($tableName);

        foreach ($rows as $row){
            $values = explode(";", $row);
            $insertValues = array();
            foreach ($columns as $key => $value){
                $insertValues[$value] = $values[$key];
            }

            //print_r($insertValues);
            $addEntryRequest->setRow($insertValues);
            $this->getAddCSVEntryFunction()->Run($addEntryRequest);
        }

        return true;
    }

    protected $addCSVTableFunction;
    protected $addCSVEntryFunction;

    /**
     * @param mixed $addCSVTableFunction
     */
    public function setAddCSVTableFunction($addCSVTableFunction)
    {
        $this->addCSVTableFunction = $addCSVTableFunction;
    }

    /**
     * @return mixed
     */
    public function getAddCSVTableFunction()
    {
        return $this->addCSVTableFunction;
    }

    /**
     * @return mixed
     */
    public function getAddCSVEntryFunction()
    {
        return $this->addCSVEntryFunction;
    }

    /**
     * @param mixed $addCSVEntryFunction
     */
    public function setAddCSVEntryFunction($addCSVEntryFunction)
    {
        $this->addCSVEntryFunction = $addCSVEntryFunction;
    }
}