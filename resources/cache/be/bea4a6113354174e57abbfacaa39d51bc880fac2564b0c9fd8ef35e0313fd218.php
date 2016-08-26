<?php

/* admin/default.html  */
class __TwigTemplate_7aede4f6802c930cac47eec8fbf73d7df2d3e3188e68d758d1c1e48852d4fe8d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'styles' => array($this, 'block_styles'),
            'body' => array($this, 'block_body'),
            'modals' => array($this, 'block_modals'),
            'scripts' => array($this, 'block_scripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
";
        // line 2
        $context["data"] = call_user_func_array($this->env->getFunction('session_flash')->getCallable(), array("data"));
        // line 3
        $context["v"] = call_user_func_array($this->env->getFunction('session_flash')->getCallable(), array("v"));
        // line 4
        echo "
<html lang=\"en\">
    <head>
        <meta charset=\"UTF-8\"/>
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <title>Our First Hand</title>
        <link rel='stylesheet' href=\"";
        // line 10
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_pub')->getCallable(), array("admin/css/bootstrap.min.css")), "html", null, true);
        echo "\" />
        <link rel='stylesheet' href=\"";
        // line 11
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_pub')->getCallable(), array("admin/css/style.css")), "html", null, true);
        echo "\"/>
        <link rel='stylesheet' href=\"";
        // line 12
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_pub')->getCallable(), array("admin/css/font-awesome.min.css")), "html", null, true);
        echo "\"/>
        <link rel='stylesheet' href=\"";
        // line 13
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_pub')->getCallable(), array("admin/css/media.css")), "html", null, true);
        echo "\"/>
        <link rel='stylesheet' href=\"";
        // line 14
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_pub')->getCallable(), array("admin/css/animate.min.css")), "html", null, true);
        echo "\"/>
        <link rel='stylesheet' href=\"http://fonts.googleapis.com/css?family=Roboto:400,700,300\"/>
        ";
        // line 16
        $this->displayBlock('styles', $context, $blocks);
        // line 17
        echo "    </head>

    <body>

        ";
        // line 21
        $this->displayBlock('body', $context, $blocks);
        // line 22
        echo "        <footer class=\"footer\">
            <div class=\"container-fluid\">
                <nav class=\"pull-left\">
                    <ul>
                        <li>
                            <a href=\"";
        // line 27
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_app')->getCallable(), array()), "html", null, true);
        echo "\">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href=\"#\">
                                Company
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class=\"copyright pull-right\">
                    &copy; 2016 <a href=\"";
        // line 39
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_app')->getCallable(), array()), "html", null, true);
        echo "\">Zakaa</a>, made with love for a better web
                </p>
            </div>
        </footer>
    </div>
</div>
";
        // line 45
        $this->displayBlock('modals', $context, $blocks);
        // line 46
        echo "
<script src=\"";
        // line 47
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_pub')->getCallable(), array("admin/js/jquery-1.12.1.min.js")), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 48
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_pub')->getCallable(), array("admin/js/bootstrap.min.js")), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 49
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_pub')->getCallable(), array("admin/js/plugins.js")), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 50
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_pub')->getCallable(), array("admin/js/jquery.nicescroll.js")), "html", null, true);
        echo "\"></script>

";
        // line 52
        $this->displayBlock('scripts', $context, $blocks);
        // line 53
        echo "</body>
</html>









";
    }

    // line 16
    public function block_styles($context, array $blocks = array())
    {
    }

    // line 21
    public function block_body($context, array $blocks = array())
    {
    }

    // line 45
    public function block_modals($context, array $blocks = array())
    {
    }

    // line 52
    public function block_scripts($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "admin/default.html ";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  154 => 52,  149 => 45,  144 => 21,  139 => 16,  124 => 53,  122 => 52,  117 => 50,  113 => 49,  109 => 48,  105 => 47,  102 => 46,  100 => 45,  91 => 39,  76 => 27,  69 => 22,  67 => 21,  61 => 17,  59 => 16,  54 => 14,  50 => 13,  46 => 12,  42 => 11,  38 => 10,  30 => 4,  28 => 3,  26 => 2,  23 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* {% set data = session_flash('data') %}*/
/* {% set v = session_flash('v') %}*/
/* */
/* <html lang="en">*/
/*     <head>*/
/*         <meta charset="UTF-8"/>*/
/*         <meta name="viewport" content="width=device-width, initial-scale=1">*/
/*         <title>Our First Hand</title>*/
/*         <link rel='stylesheet' href="{{ url_pub('admin/css/bootstrap.min.css') }}" />*/
/*         <link rel='stylesheet' href="{{ url_pub('admin/css/style.css') }}"/>*/
/*         <link rel='stylesheet' href="{{ url_pub('admin/css/font-awesome.min.css') }}"/>*/
/*         <link rel='stylesheet' href="{{ url_pub('admin/css/media.css') }}"/>*/
/*         <link rel='stylesheet' href="{{ url_pub('admin/css/animate.min.css') }}"/>*/
/*         <link rel='stylesheet' href="http://fonts.googleapis.com/css?family=Roboto:400,700,300"/>*/
/*         {% block styles %}{% endblock %}*/
/*     </head>*/
/* */
/*     <body>*/
/* */
/*         {% block body %}{% endblock %}*/
/*         <footer class="footer">*/
/*             <div class="container-fluid">*/
/*                 <nav class="pull-left">*/
/*                     <ul>*/
/*                         <li>*/
/*                             <a href="{{ url_app() }}">*/
/*                                 Home*/
/*                             </a>*/
/*                         </li>*/
/*                         <li>*/
/*                             <a href="#">*/
/*                                 Company*/
/*                             </a>*/
/*                         </li>*/
/*                     </ul>*/
/*                 </nav>*/
/*                 <p class="copyright pull-right">*/
/*                     &copy; 2016 <a href="{{ url_app() }}">Zakaa</a>, made with love for a better web*/
/*                 </p>*/
/*             </div>*/
/*         </footer>*/
/*     </div>*/
/* </div>*/
/* {% block modals %}{% endblock %}*/
/* */
/* <script src="{{ url_pub('admin/js/jquery-1.12.1.min.js') }}"></script>*/
/* <script src="{{ url_pub('admin/js/bootstrap.min.js') }}"></script>*/
/* <script src="{{ url_pub('admin/js/plugins.js') }}"></script>*/
/* <script src="{{ url_pub('admin/js/jquery.nicescroll.js') }}"></script>*/
/* */
/* {% block scripts %}{% endblock %}*/
/* </body>*/
/* </html>*/
/* */
/* */
/* */
/* */
/* */
/* */
/* */
/* */
/* */
/* */
