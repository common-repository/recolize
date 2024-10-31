<?php
/**
 * Recolize WordPress Page Type
 *
 * @section LICENSE
 * This source file is subject to the GNU General Public License Version 3 (GPLv3).
 *
 * @category Recolize
 * @package Recolize_RecommendationEngine
 * @author Recolize GmbH <service@recolize.com>
 * @copyright 2015 Recolize GmbH (http://www.recolize.com)
 * @license http://opensource.org/licenses/GPL-3.0 GNU General Public License Version 3 (GPLv3).
 */
class Recolize_PageType
{
    /**
     * Add Recolize parameters javascript depending on page type.
     *
     * @return Recolize_PageType
     */
    public function initialize()
    {
        add_action('wp_head', array($this, 'dispatch'), 1);
        return $this;
    }

    /**
     * Dispatch Recolize parameters depending on WordPress page type.
     *
     * @return Recolize_PageType
     */
    public function dispatch()
    {
        $parameters = array();
        if (is_single() === true) {
            $parameters = $this->_getPostParameters();
        } elseif (is_category() === true) {
            $parameters = $this->_getCategoryParameters();
        }

        $this->_renderParameterSnippet($parameters);

        return $this;
    }

    /**
     * Return all required Recolize parameters for a blog post page.
     *
     * @return array
     */
    protected function _getPostParameters()
    {
        return array('specialPageType' => 'item-detail', 'currentItemId' => get_the_guid());
    }

    /**
     * Return all required Recolize parameters for a category page.
     *
     * @return array
     */
    protected function _getCategoryParameters()
    {
        $category = get_the_category();
        if (empty($category[0]) === true) {
            return array();
        }

        $categoryName = get_cat_name($category[0]->term_id);

        return array('specialPageType' => 'category', 'categoryId' => $categoryName);
    }

    /**
     * Render the Recolize parameters JavaScript code.
     *
     * @param array $parameters the parameters for the current page type
     *
     * @return Recolize_PageType
     */
    protected function _renderParameterSnippet(array $parameters)
    {
        if (empty($parameters) === true) {
            return $this;
        }

        $javaScriptSnippet = '<script type="text/javascript">var RecolizeParameters = {};';
        foreach ($parameters as $parameterName => $parameterValue) {
            $javaScriptSnippet .= sprintf("RecolizeParameters['%s'] = '%s';", $parameterName, $parameterValue);
        }
        $javaScriptSnippet .= '</script>';

        echo $javaScriptSnippet;

        return $this;
    }
}