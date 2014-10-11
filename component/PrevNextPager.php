<?php

namespace app\component;

use Yii;
use yii\widgets\LinkPager;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pager
 *
 * @author dd
 *
 *      <div id="pager" style="display: none;">
 *          <div id="first-page" class="page-item"><a href="javascript:void(0);" onclick="gotoPage(1);"><img src="/images/first_page.png" title="第一页" /></a></div>
 *          <div id="prev-page" class="page-item"><a href="javascript:void(0);" onclick=""><img src="/images/prev_page.png" /></a></div>
 *          <div id="pages" class="page-item">
 *              <ul id="pages-holder">
 *              </ul>
 *          </div>
 *          <div id="next-page" class="page-item"><a href="javascript:void(0);" onclick=""><img src="/images/next_page.png" /></a></div>
 *          <div id="last-page" class="page-item"><a href="javascript:void(0);" onclick=""><img src="/images/last_page.png" /></a></div>
 *          <div id="num-page" class="page-item">共<span id="num-of-page"></span>页</div>
 *          <div id="goto-page" class="page-item">
 *              <input type="text" corner="5px left" id="goto-page-num" />
 *              <a href="javascript:void(0);" id="goto-page-button"><img corner="5px right" src="/images/goto_page.png" title="去指定页" /></a>
 *          </div>
 *      </div>
 */
class PrevNextPager extends LinkPager {

    public $htmlOptions = [ 'class' => '' ];

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        if ($this->registerLinkTags) {
            $this->registerLinkTags();
        }
        echo $this->renderPageButtons();
    }   

    public function renderPageButtons() 
    {

        $pageCount = $this->pagination->getPageCount();
        if ($pageCount < 2 && $this->hideOnSinglePage) {
            return '';
        }

        $currentPage = $this->pagination->getPage();

        $html = '';
        $html .= '<div class="pagination">';
        // $html .= '<li><a href="'. $this->pagination->createUrl(0) .'">首页</a></li>';
        // $html .= '<div class="fr pagination-btn previous '. ($currentPage == 0 ? 'disabled' : '') .'"><a class="orange" href="'. ($currentPage > 0 ? $this->pagination->createUrl($currentPage - 1) : $this->pagination->createUrl(0)) .'"">上一页</a></div>';

        // $i = $currentPage - 2;
        // if($i < 0) $i = 0;  
        // for(; $i < $pageCount && $i <= ($currentPage + 2); $i++)
        // {
        //     if($i != $currentPage)
        //     {
        //         $html .= '<li ><a href="'. $this->pagination->createUrl($i) .'">'. ($i + 1) .'</a></li>';
        //     }
        //     else
        //     {
        //         $html .= '<li class="active"><a href="'. $this->pagination->createUrl($i) .'">'. ($i + 1) .'</a></li>';
        //     }
        // }
        // $html .= '<div class="clear"></div>';
        $html .= '<div class="fr pagination-btn next '. ($currentPage == $pageCount - 1 ? 'disabled' : '') .'"><a class="orange" href="'. ($currentPage < $pageCount - 1 ? $this->pagination->createUrl($currentPage + 1) : $this->pagination->createUrl($pageCount - 1)) .'">下一页</a></div>';
        $html .= '<div class="fr pagination-btn previous '. ($currentPage == 0 ? 'disabled' : '') .'"><a class="orange" href="'. ($currentPage > 0 ? $this->pagination->createUrl($currentPage - 1) : $this->pagination->createUrl(0)) .'"">上一页</a></div>';
        // $html .= '<li><a href="'. $this->pagination->createUrl($pageCount - 1) .'">末页</a></li>';
        $html .= '</div>';

        return $html;
    }
}

?>
