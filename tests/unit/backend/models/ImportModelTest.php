<?php

use Backend\Models\ImportModel;

if (!class_exists('Model')) {
    class_alias('Winter\Storm\Database\Model', 'Model');
}

class ExampleImportModel extends ImportModel
{
    public $rules = [];

    public function importData($results, $sessionKey = null)
    {
        return [];
    }
}

class ImportModelTest extends TestCase
{

    //
    // Tests
    //

    public function testDecodeArrayValue()
    {
        $model = new ExampleImportModel;
        $data = 'foo|bar';
        $result = self::callProtectedMethod($model, 'decodeArrayValue', [$data]);
        $this->assertEquals(['foo', 'bar'], $result);

        $data = 'dps \| heals \| tank|paladin|berserker|gunner';
        $result = self::callProtectedMethod($model, 'decodeArrayValue', [$data]);
        $this->assertEquals(['dps | heals | tank', 'paladin', 'berserker', 'gunner'], $result);

        $data = 'art direction-roman empire-sci\-fi';
        $result = self::callProtectedMethod($model, 'decodeArrayValue', [$data, '-']);
        $this->assertEquals(['art direction', 'roman empire', 'sci-fi'], $result);
    }
}
