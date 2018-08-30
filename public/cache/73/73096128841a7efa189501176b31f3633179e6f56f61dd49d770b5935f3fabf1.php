<?php

/* index.twig */
class __TwigTemplate_017a7044baa39fa62f85b22262a9c399d105d75a927d5fda7d68778b7c2b7925 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "Home!";
    }

    public function getTemplateName()
    {
        return "index.twig";
    }

    public function getDebugInfo()
    {
        return array (  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "index.twig", "/app/public/templates/index.twig");
    }
}
