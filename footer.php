<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

        </div><!-- end .row -->
    </div>
</div><!-- end #body -->

<footer id="footer" role="contentinfo">
    <p>Copyright &copy; <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a> All rights reserved.</p>
    <p>All contents on this website is licensed under <a href=" https://creativecommons.org/licenses/by/4.0/">CC-BY-4.0<img src="https://mirrors.creativecommons.org/presskit/buttons/88x31/svg/by.svg" style="height:18px!important;vertical-align:text-bottom;display:inline-block;margin-left:3px;" alt="CC BY 4.0"/></a></p>
    <p><?php _e('由 <a href="https://typecho.org">Typecho</a> 强力驱动'); ?>.</p>
</footer><!-- end #footer -->

<?php $this->footer(); ?>
</body>
</html>
