<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

use \Typecho\Widget\Helper\Form\Element\Textarea;
use \Typecho\Widget\Helper\Form\Element\Text;
use Typecho\Widget\Helper\Layout;
use Widget\Notice;

function themeConfig($form)
{
    $logoUrl = new Text(
        'logoUrl',
        null,
        null,
        _t('站点 LOGO 地址'),
        _t('在这里填入一个图片 URL 地址, 以在网站标题前加上一个 LOGO')
    );

    $form->addInput($logoUrl->addRule('url', _t('请填写一个合法的URL地址')));

    $sidebarBlock = new \Typecho\Widget\Helper\Form\Element\Checkbox(
        'sidebarBlock',
        [
            'ShowRecentPosts'    => _t('显示最新文章'),
            'ShowRecentComments' => _t('显示最近回复'),
            'ShowCategory'       => _t('显示分类'),
            'ShowArchive'        => _t('显示归档'),
            'ShowOther'          => _t('显示其它杂项')
        ],
        ['ShowRecentPosts', 'ShowRecentComments', 'ShowCategory', 'ShowArchive', 'ShowOther'],
        _t('侧边栏显示')
    );

    $form->addInput($sidebarBlock->multiMode());
}

function themeSetup(\Widget\Themes\Edit $edit)
{
    print '主题被启动';
    /** 修改表结构增加自定义摘要和自定义关键字 */
    $db = Typecho\Db::get();
    checkDb($db);
}

function postMeta(
    \Widget\Archive $archive,
    string $metaType = 'archive'
)
{
    $titleTag = $metaType == 'archive' ? 'h2' : 'h1';
?>
    <<?php echo $titleTag ?> class="post-title" itemprop="name headline">
        <a itemprop="url"
           href="<?php $archive->permalink() ?>"><?php $archive->title() ?></a>
    </<?php echo $titleTag ?>>
    <?php if ($metaType != 'page'): ?>
        <ul class="post-meta">
            <li itemprop="author" itemscope itemtype="http://schema.org/Person">
                <?php _e('作者'); ?>: <a itemprop="name"
                                       href="<?php $archive->author->permalink(); ?>"
                                       rel="author"><?php $archive->author(); ?></a>
            </li>
            <li><?php _e('时间'); ?>:
                <time datetime="<?php $archive->date('c'); ?>" itemprop="datePublished"><?php $archive->date(); ?></time>
            </li>
            <li><?php _e('分类'); ?>: <?php $archive->category(','); ?></li>
            <?php if ($metaType == 'archive'): ?>
                <li itemprop="interactionCount">
                    <a itemprop="discussionUrl"
                       href="<?php $archive->permalink() ?>#comments"><?php $archive->commentsNum(_t('评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?></a>
                </li>
            <?php endif; ?>
        </ul>
    <?php endif; ?>
<?php
}


function themeFields(Layout $layout)
{
    /** 自定义摘要 */
    $layout->addItem(new Textarea('summaryContent', null, null, _t('自定义摘要'), _t('在此处为文章定义摘要内容，此处定义的摘要不受字数限制')));

    /** 自定义关键字 */
    $layout->addItem(new Text('keywords', null, null, _t('自定义关键字'), _t('在此输入为文章输入关键字，使用逗号分隔，如果为空则使用标签作为关键字')));
}

function checkDb(\Typecho\Db $db)
{
    $prefix = $db->getPrefix();
    try {
        $scripts=<<<heredoc
        CREATE TABLE IF NOT EXISTS typecho_lecture_post_meta ( "coid" INTEGER NOT NULL PRIMARY KEY,
        "cid" int(10) default '0' ,
        "summaryContent" text , 
        "keywords" varchar(255) default NULL);

        CREATE INDEX idx_lecture_meta_cid ON typecho_lecture_post_meta(cid);
        heredoc;

        # 替换typecho为前缀
        $scripts = str_replace('typecho_', $prefix, $scripts);
        $db->query($scripts, \Typecho\Db::WRITE);
    } catch (\Typecho\Db\Exception $e) {
        /** 目前显示效果是无效的，会被外观已经改变覆盖 */
        Notice::alloc()->set(_t('启动主题捕捉到以下错误: "%s"', $e->getMessage()), 'notice');
        return false;
    }
    return true;
}

