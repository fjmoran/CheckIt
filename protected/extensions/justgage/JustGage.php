<?php

/**
 * JustGage for YII.
 *
 * @author Christian Oviedo <christian.oviedo@gmail.com>
 * @version 1.0
 */

/**
 * JustGage for YII encapsulates the {@link http://www.highcharts.com/ Highcharts}
 * charting library's Chart object.
 *
 * To use this widget, you may insert the following code in a view:
 * <pre>
 *    <?php $this->Widget('ext.justgage.JustGage', array(
 *       'options'=>array(
 *           'value' => 67, 
 *           'min' => 0,
 *           'max' => 100,
 *           'title' => "Visitors",
 *       ),
 *       'htmlOptions'=> array(
 *           'class' => '200x160px',
 *       ),
 *   ));?>
 *
 * </pre>
 *
 * By configuring the {@link $options} property, you may specify the options
 * that need to be passed to the Highcharts JavaScript object. Please refer to
 * the demo gallery and documentation on the {@link http://www.highcharts.com/
 * Highcharts website} for possible options.
 *
 * Alternatively, you can use a valid JSON string in place of an associative
 * array to specify options:
 *
 * <pre>
 * $this->Widget('ext.highcharts.HighchartsWidget', array(
 *    'options'=>'{
 *       "title": { "text": "Fruit Consumption" },
 *       "xAxis": {
 *          "categories": ["Apples", "Bananas", "Oranges"]
 *       },
 *       "yAxis": {
 *          "title": { "text": "Fruit eaten" }
 *       },
 *       "series": [
 *          { "name": "Jane", "data": [1, 0, 4] },
 *          { "name": "John", "data": [5, 7,3] }
 *       ]
 *    }'
 * ));
 * </pre>
 *
 * Note: You must provide a valid JSON string (e.g. double quotes) when using
 * the second option. You can quickly validate your JSON string online using
 * {@link http://jsonlint.com/ JSONLint}.
 *
 * Note: You do not need to specify the <code>chart->renderTo</code> option as
 * is shown in many of the examples on the Highcharts website. This value is
 * automatically populated with the id of the widget's container element. If you
 * wish to use a different container, feel free to specify a custom value.
 */
class JustGage extends CWidget
{
    protected $_constr = 'Chart';
    public $options = array();
    public $htmlOptions = array();
    public $setupOptions = array();

    /**
     * Renders the widget.
     */
    public function run()
    {
        if (isset($this->htmlOptions['id'])) {
            $id = $this->htmlOptions['id'];
        } else {
            $id = $this->htmlOptions['id'] = $this->getId();
        }

        echo CHtml::openTag('div', $this->htmlOptions);
        echo CHtml::closeTag('div');

        // check if options parameter is a json string
        if (is_string($this->options)) {
            if (!$this->options = CJSON::decode($this->options)) {
                throw new CException('The options parameter is not valid JSON.');
            }
        }

        // merge options with default values
        $defaultOptions = array('id' => $id);
        $this->options = CMap::mergeArray($defaultOptions, $this->options);
        //array_unshift($this->scripts, $this->_baseScript);

        $jsOptions = CJavaScript::encode($this->options);
//        $setupOptions = CJavaScript::encode($this->setupOptions);
        $this->registerScripts(__CLASS__ . '#' . $id, "var g = new JustGage($jsOptions);");
    }

    /**
     * Publishes and registers the necessary script files.
     *
     * @param string the id of the script to be inserted into the page
     * @param string the embedded script to be inserted into the page
     */
    protected function registerScripts($id, $embeddedScript)
    {
        $basePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR;
        $baseUrl = Yii::app()->getAssetManager()->publish($basePath, false, 1, YII_DEBUG);

        $extension = '.min.js';

        $cs = Yii::app()->clientScript;
        $cs->registerCoreScript('jquery');
        $cs->registerScriptFile("{$baseUrl}/raphael.2.1.0{$extension}");
        $cs->registerScriptFile("{$baseUrl}/justgage.1.0.1{$extension}");

        // register embedded script
        $cs->registerScript($id, $embeddedScript, CClientScript::POS_LOAD);
    }
}
