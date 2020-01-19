<?php

class TemplateEngine {

    protected $templateFolder;

    protected $cacheFolder;

    public function __construct($templateFolder, $cacheFolder = null)
    {
        if(!$cacheFolder) $cacheFolder = ROOT .'/app/admin/caches/views';
        $this->setTemplateFolder($templateFolder);
        $this->setTemplateCacheFolder($cacheFolder);
    }

    public function setTemplateFolder($templateFolder)
    {
        $this->templateFolder = $templateFolder;
        return $this;
    }

    public function getTemplateFolder()
    {
        return $this->templateFolder;
    }

    public function setTemplateCacheFolder($cacheFolder)
    {
        $this->cacheFolder = $cacheFolder;
    }

    public function getTemplateCacheFolder()
    {
        return $this->cacheFolder;
    }

    public function render($templatePath, array $data = array())
    {
        // Share global variables
        $data['list'] = new fsDataGird('', '', "List");
        $data['errors'] = (array) flash_message('errors');
        $data['oldInputs'] = (array) flash_message('old_inputs');
        $data['list'] = new fsDataGird('', '', "Danh sach");

        $template = $this->getProvider()->view()->make($templatePath, $data);

        $content = $template->render();

        // Clear flash message
        unset($_SESSION['flash_message']);

        return $content;
    }

    public function getProvider()
    {
        // $loader = new Twig_Loader_Filesystem([$this->getTemplateFolder(), ROOT . '/app/admin/layout']);
        // $twig = new Twig_Environment($loader, array(
        //     'cache' => $this->getTemplateCacheFolder(),
        //     'auto_reload' => true,
        //     'debug' => true
        // ));

        $views = [$this->getTemplateFolder(), ROOT . '/app/admin/layout'];
        $cache = $this->getTemplateCacheFolder();

        $blade = new Philo\Blade\Blade($views, $cache);

        return $blade;
    }
}