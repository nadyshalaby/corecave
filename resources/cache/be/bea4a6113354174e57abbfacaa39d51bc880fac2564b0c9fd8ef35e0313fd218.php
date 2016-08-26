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
        echo "<html lang=\"en\">
    <head>
        <meta charset=\"UTF-8\"/>
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <title>Our First Hand</title>
        <link rel='stylesheet' href=\"";
        // line 8
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_pub')->getCallable(), array("admin/css/bootstrap.min.css")), "html", null, true);
        echo "\" />
        <link rel='stylesheet' href=\"";
        // line 9
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_pub')->getCallable(), array("admin/css/style.css")), "html", null, true);
        echo "\"/>
        <link rel='stylesheet' href=\"";
        // line 10
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_pub')->getCallable(), array("admin/css/font-awesome.min.css")), "html", null, true);
        echo "\"/>
        <link rel='stylesheet' href=\"";
        // line 11
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_pub')->getCallable(), array("admin/css/media.css")), "html", null, true);
        echo "\"/>
        <link rel='stylesheet' href=\"";
        // line 12
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_pub')->getCallable(), array("admin/css/animate.min.css")), "html", null, true);
        echo "\"/>
        <link rel='stylesheet' href=\"http://fonts.googleapis.com/css?family=Roboto:400,700,300\"/>
        ";
        // line 14
        $this->displayBlock('styles', $context, $blocks);
        // line 15
        echo "    </head>

    <body>

        ";
        // line 19
        $this->displayBlock('body', $context, $blocks);
        // line 20
        echo "        <footer class=\"footer\">
            <div class=\"container-fluid\">
                <nav class=\"pull-left\">
                    <ul>
                        <li>
                            <a href=\"";
        // line 25
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
        // line 37
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_app')->getCallable(), array()), "html", null, true);
        echo "\">Zakaa</a>, made with love for a better web
                </p>
            </div>
        </footer>
    </div>
</div>
";
        // line 43
        $this->displayBlock('modals', $context, $blocks);
        // line 44
        echo "
<script src=\"";
        // line 45
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_pub')->getCallable(), array("admin/js/jquery-1.12.1.min.js")), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 46
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_pub')->getCallable(), array("admin/js/bootstrap.min.js")), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 47
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_pub')->getCallable(), array("admin/js/plugins.js")), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 48
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_pub')->getCallable(), array("admin/js/jquery.nicescroll.js")), "html", null, true);
        echo "\"></script>

";
        // line 50
        $this->displayBlock('scripts', $context, $blocks);
        // line 51
        echo "</body>
</html>









";
    }

    // line 14
    public function block_styles($context, array $blocks = array())
    {
    }

    // line 19
    public function block_body($context, array $blocks = array())
    {
    }

    // line 43
    public function block_modals($context, array $blocks = array())
    {
    }

    // line 50
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
        return array (  151 => 50,  146 => 43,  141 => 19,  136 => 14,  121 => 51,  119 => 50,  114 => 48,  110 => 47,  106 => 46,  102 => 45,  99 => 44,  97 => 43,  88 => 37,  73 => 25,  66 => 20,  64 => 19,  58 => 15,  56 => 14,  51 => 12,  47 => 11,  43 => 10,  39 => 9,  35 => 8,  28 => 3,  26 => 2,  23 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* {% set data = session_flash('data') %}*/
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
