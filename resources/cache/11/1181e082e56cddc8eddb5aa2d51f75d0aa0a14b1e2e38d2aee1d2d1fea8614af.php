<?php

/* error/404.html */
class __TwigTemplate_2dc9273c847bff21b799e65c949e1f2ab064709046a4a60e813d25bcd01754bb extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 2
        $this->parent = $this->loadTemplate("admin/default.html", "error/404.html", 2);
        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "admin/default.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        // line 4
        echo "<!--Start Page content-->
<section class=\"error\">
    <div class=\"container text-center\">
        <div class=\"row\">
            <div class=\"content col-sm-12 col-md-push-0 col-xs-10 col-xs-push-1\">
                <h1>404 Error Page</h1>
                <p>الصفحة المطلوبة غير متوفرة حاليا ، من فضلك حاول فيما بعد</p>
                <a class=\"btn\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_route')->getCallable(), array("home")), "html", null, true);
        echo "\"> العودة للرئيسية</a>
            </div>
        </div>
    </div>
</section>
<!--End Page content-->
";
    }

    public function getTemplateName()
    {
        return "error/404.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  40 => 11,  31 => 4,  28 => 3,  11 => 2,);
    }
}
/* */
/* {% extends 'admin/default.html'%}*/
/* {% block body %}*/
/* <!--Start Page content-->*/
/* <section class="error">*/
/*     <div class="container text-center">*/
/*         <div class="row">*/
/*             <div class="content col-sm-12 col-md-push-0 col-xs-10 col-xs-push-1">*/
/*                 <h1>404 Error Page</h1>*/
/*                 <p>الصفحة المطلوبة غير متوفرة حاليا ، من فضلك حاول فيما بعد</p>*/
/*                 <a class="btn" href="{{ url_route('home') }}"> العودة للرئيسية</a>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* </section>*/
/* <!--End Page content-->*/
/* {% endblock %} */
