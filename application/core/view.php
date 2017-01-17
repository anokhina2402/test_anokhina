<?php

/** class of view **/
class View
{

    /**
     * method for generate view
     * @param $content_view - name of view
     * @param $template_view - name of main view
     * @param $data - array of data with show in view
     */

    function generate($content_view, $template_view, $data = null)
    {


        /** include view **/
        include_once 'application/views/' . $template_view;
    }
}
