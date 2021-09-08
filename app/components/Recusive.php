<?php

namespace App\Components;

class Recusive
{
    private $dataModel;
    private $htmlOptions;
    function __construct($dataModel)
    {
        $this->dataModel = $dataModel;
    }

    function getOptionsChildrent($subID, $id = '0', $subtext = '')
    {
        foreach ($this->dataModel as $value) {
            if ($value['parent_id'] == $id) {
                if (!empty($subID) && $subID == $value['id']) {
                    $this->htmlOptions .= '<option selected value="' . $value['id'] . '">' . $subtext . $value['name'] . '</option>';
                } else {
                    $this->htmlOptions .= '<option value="' . $value['id'] . '" >' . $subtext . $value['name'] . '</option>';
                    $this->getOptionsChildrent($subID, $value['id'], $subtext . '--');
                }
            }
        }
        return $this->htmlOptions;
    }
}
