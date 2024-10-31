<?php
/**
 * Recolize WordPress JavaScript Snippet
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
class Recolize_JavaScriptSnippet
{
    /**
     * Initialize the insertion of the Recolize JavaScript snippet into the page head.
     *
     * @return Recolize_JavaScriptSnippet
     */
    public function initialize()
    {
        add_action('wp_head', array($this, 'addRecolizeJavaScriptSnippetToHead'));
        return $this;
    }

    /**
     * Add the Recolize javascript snippet to the page head.
     *
     * @return Recolize_JavaScriptSnippet
     */
    public function addRecolizeJavaScriptSnippetToHead()
    {
        echo Recolize_Admin_Settings::getJavaScriptSnippet();
        return $this;
    }
}