<?php
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 22.09.2017
 * Time: 13:27
 */

namespace Trafik8787\laraCrud2\Form\Component;


use Illuminate\Support\Facades\Request;
use Trafik8787\laraCrud2\Contracts\Component\ComponentManagerBuilderInterface;


/**
 * Class ComponentManagerBuilder
 * @package Trafik8787\laraCrud2\Form\Component
 * patern Builder
 */
class ComponentManagerBuilder implements ComponentManagerBuilderInterface
{

    public $objField;
    public $type; //тип поля input
    public $classStyle;
    public $placeholder;
    public $value;
    public $label;
    public $name;
    public $title;
    public $enableEditor;
    public $multiple;
    public $options;
    public $tooltip;
    public $one_to_many;
    public $required;


    /**
     * ComponentManagerBuilder constructor.
     * @param null $arrField
     */
    public function __construct($arrField = null)
    {

        $this->objField = $arrField;
    }


    /**
     * @param null $data
     * @return $this
     */
    public function classStyle($data = null)
    {
        $this->classStyle = $data;

        if ($data === null) {
            $this->classStyle = $this->objField['classStyle'];
        }

        return $this;
    }


    /**
     * @param null $data
     * @return $this
     */
    public function placeholder($data = null)
    {
        $this->placeholder = $data;

        if ($data === null) {
            $this->placeholder = $this->objField['placeholder'];
        }

        return $this;
    }


    /**
     * @param string $data
     * @return $this
     */
    public function value($data = '')
    {
        $this->value = $data;
        return $this;
    }

    /**
     * @param string $data
     */
    public function multiple($data = null)
    {
        $this->multiple = $data;

        if ($data === null) {
            $this->multiple = $this->objField['multiple'];
        }
    }

    /**
     * @param null $data
     */
    public function OneToMany($data = null)
    {
        $this->one_to_many = $data;
        if ($data === null) {
            $this->one_to_many = $this->objField['one_to_many'];
        }
    }

    /**
     * @param null $data
     * @return $this
     */
    public function type($data = null)
    {
        $this->type = $data;

        if ($data === null) {
            $this->type = $this->objField['type'];
        }

        return $this;
    }


    /**
     * @param null $data
     * @return $this
     */
    public function label($data = null)
    {
        $this->label = $data;

        if ($data === null) {
            $this->label = $this->objField['label'];
        }

        return $this;
    }


    /**
     * @param null $data
     * @return $this
     */
    public function tooltip($data = null)
    {
        $this->tooltip = $data;

        if ($data === null) {
            $this->tooltip = $this->objField['tooltip'];
        }

        return $this;
    }

    /**
     * @param null $data
     * @return $this
     */
    public function name($data = null)
    {
        $this->name = $data;

        if ($data === null) {
            $this->name = $this->objField['field'];
        }

        return $this;
    }


    /**
     * @param null $data
     * @return $this
     */
    public function title($data = null)
    {
        $this->title = $data;

        if ($data === null) {
            $this->title = $this->objField['title'];
        }

        return $this;
    }

    /**
     * @param null $data
     * @return $this
     */
    public function attribute($data = null)
    {
        $this->attribute = $data;

        if ($data === null) {
            $this->attribute = $this->objField['attribute'];
        }

        return $this;
    }


    /**
     * @param null $data
     * @return $this
     */
    public function enableEditor($data = null)
    {
        $this->enableEditor = $data;

        if ($data === null) {
            $this->enableEditor = $this->objField['enableEditor'];
        }

        return $this;
    }


    /**
     * @return Select|Text|Textarea
     */
    public function build()
    {
        switch ($this->objField['typeField']) {

            case 'select':
                return new Select($this);
                break;
            case 'textarea':
                return new Textarea($this);
                break;
            case 'file':
                return new File($this);
                break;
            case 'checkbox':
                return new Checkbox($this);
                break;
            case 'radio':
                return new Radio($this);
                break;
            default:
                return new Text($this);
        }

    }

    /**
     * @param null $data
     * @return $this
     */
    public function options($data = null)
    {
        $this->options = $data;

        if ($data === null) {
            $this->options = $this->objField['options'];
        }

        return $this;
    }


    /**
     * @param null $data
     * @return $this
     */
    public function required($data = false)
    {
        $this->required = $data;

        if ($data === false) {
            $this->required = $this->objField['required'];
        }

        return $this;
    }
}
