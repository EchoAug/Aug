<?php
/**
 * Created by PhpStorm.
 * User: Valentine.Fang
 * Date: 2018/3/11
 * Time: 12:03
 */

namespace App\Util;


trait Tree
{
    private $obj;

    /**
     * @param $array
     * @param string $pidName
     * @param string $childKeyName
     * @return array|mixed
     */
    public function array2Tree(&$array, $pidName = 'pid', $childKeyName = 'children')
    {
        $counter = $this->arrayChildrenCount($array, $pidName);
        if (!isset($counter[0]) || $counter[0] == 0) {
            return $array;
        }
        $tree = [];
        while (isset($counter[0]) && $counter[0] > 0) {
            $temp = array_shift($array);
            if (isset($counter[$temp['id']]) && $counter[$temp['id']] > 0) {
                array_push($array, $temp);
            } else {
                if ($temp[$pidName] == 0) {
                    $tree[] = $temp;
                } else {
                    $array = $this->arrayChildrenAppend($array, $temp[$pidName], $temp, $childKeyName);
                }
            }
            $counter = $this->arrayChildrenCount($array, $pidName);
        }
        return $tree;
    }

    /**
     * 子元素计数器
     * @param array $array
     * @param int $pid
     * @return array
     */
    private function arrayChildrenCount($array, $pid)
    {
        $counter = [];
        foreach ($array as $item) {
            $count = isset($counter[$item[$pid]]) ? $counter[$item[$pid]] : 0;
            $count++;
            $counter[$item[$pid]] = $count;
        }
        return $counter;
    }

    /**
     * 把元素插入到对应的父元素$childKeyName
     * @param        $parent
     * @param        $pid
     * @param        $child
     * @param string $childKeyName 子元素键名
     * @return mixed
     */
    private function arrayChildrenAppend($parent, $pid, $child, $childKeyName)
    {
        foreach ($parent as &$item) {
            if ($item['id'] == $pid) {
                if (!isset($item[$childKeyName])) {
                    $item[$childKeyName] = [];
                }

                $item[$childKeyName][] = $child;
            }
        }
        return $parent;
    }

    //数组转换为带层级关系的数组树
    public function array2LevelTree(&$array, $pid = 0, $level = 0)
    {
        static $arrayList = [];
        foreach ($array as $value) {
            if ($value['pid'] == $pid) {
                $value['level'] = $level;
                $arrayList[] = $value;
                $this->array2LevelTree($array, $value['id'], $level + 1);
            }
        }
        return $arrayList;
    }

    public function obj2LevelTree(&$obj, $pid = 0, $level = 0)
    {
        $this->obj = $obj;
        foreach ($obj as $value) {
            if ($value->pid == $pid) {
                $value->level = $level;
                $this->obj2LevelTree($this->obj, $value['id'], $level + 1);
            }
        }
        return $this->obj;
    }
}