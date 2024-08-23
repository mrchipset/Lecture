<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="col-mb-12 col-8" id="main" role="main">
    <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
        <?php postMeta($this, 'post'); ?>
        <div class="post-content" itemprop="articleBody">
            <?php $this->content(); ?>
        </div>
        <p itemprop="keywords" class="tags"><?php _e('标签'); ?>: <?php $this->tags(', ', true, 'none'); ?></p>
    </article>

    <div class="post-license-signature">
        <table class="post-license-signature-table" frame="void" rules=none style="border: 1px solid #f8f8f8">
            <tr class="post-license-signature-table">
                <td class="post-license-signature-table" align="right"><?php _e('作者');?>:</td>
                <td class="post-license-signature-table" align="left"><?php $this->author();?></td>
            </tr>
            <tr class="post-license-signature-table">
                <td class="post-license-signature-table" align="right"><?php _e('引用');?>:</td>
                <td class="post-license-signature-table" align="left"><a href="<?php $this->url();?>"><?php $this->url();?></a></td>
            </tr class="post-license-signature-table">
            <tr class="post-license-signature-table">
                <td class="post-license-signature-table" align="right"><?php _e('版权');?>:</td>
                <td class="post-license-signature-table" align="left"><?php _e('本文采用<a href="http://creativecommons.org/licenses/by/4.0/" target="_blank">「知识共享署名 4.0 国际许可协议」</a>进行许可。');?></td>
            </tr>
        </table>
        <!-- <p><?php _e('作者');?>: <?php $this->author();?></p>
        <p><?php _e('引用');?>: <a href="<?php $this->url();?>"><?php $this->url();?></a></p>
        <p><?php _e('版权');?>: <?php _e('本文采用<a href="http://creativecommons.org/licenses/by/4.0/" target="_blank">「知识共享署名 4.0 国际许可协议」</a>进行许可。');?></p> -->
    </div>
    <ul class="post-near">
        <li>上一篇: <?php $this->thePrev('%s', _t('没有了')); ?></li>
        <li>下一篇: <?php $this->theNext('%s', _t('没有了')); ?></li>
    </ul>
    <?php $this->need('comments.php'); ?>

</div><!-- end #main-->

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
