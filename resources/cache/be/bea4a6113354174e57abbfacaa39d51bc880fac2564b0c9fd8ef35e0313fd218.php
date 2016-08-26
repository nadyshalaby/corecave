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
        echo "
<html lang=\"en\">
    <head>
        <meta charset=\"UTF-8\"/>
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <title>Our First Hand</title>
        <link rel='stylesheet' href=\"";
        // line 9
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_pub')->getCallable(), array("admin/css/bootstrap.min.css")), "html", null, true);
        echo "\" />
        <link rel='stylesheet' href=\"";
        // line 10
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_pub')->getCallable(), array("admin/css/style.css")), "html", null, true);
        echo "\"/>
        <link rel='stylesheet' href=\"";
        // line 11
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_pub')->getCallable(), array("admin/css/font-awesome.min.css")), "html", null, true);
        echo "\"/>
        <link rel='stylesheet' href=\"";
        // line 12
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_pub')->getCallable(), array("admin/css/media.css")), "html", null, true);
        echo "\"/>
        <link rel='stylesheet' href=\"";
        // line 13
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_pub')->getCallable(), array("admin/css/animate.min.css")), "html", null, true);
        echo "\"/>
        <link rel='stylesheet' href=\"http://fonts.googleapis.com/css?family=Roboto:400,700,300\"/>
        ";
        // line 15
        $this->displayBlock('styles', $context, $blocks);
        // line 16
        echo "    </head>

    <body>
        ";
        // line 19
        if (call_user_func_array($this->env->getFunction('session_has')->getCallable(), array("success"))) {
            // line 20
            echo "        <div class=\"alert alert-success center-block text-center\">
            ";
            // line 21
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('session_flash')->getCallable(), array("success")), "html", null, true);
            echo "
            <span class=\"close\" data-dismiss='alert'>&times;</span>
        </div>
        ";
        }
        // line 25
        echo "        ";
        if (call_user_func_array($this->env->getFunction('session_has')->getCallable(), array("error"))) {
            // line 26
            echo "        <div class=\"alert alert-danger center-block text-center\">
            ";
            // line 27
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('session_flash')->getCallable(), array("error")), "html", null, true);
            echo "
            <span class=\"close\" data-dismiss='alert'>&times;</span>
        </div>
        ";
        }
        // line 31
        echo "        ";
        if (call_user_func_array($this->env->getFunction('session_has')->getCallable(), array("waring"))) {
            // line 32
            echo "        <div class=\"alert alert-waring center-block text-center\">
            ";
            // line 33
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('session_flash')->getCallable(), array("waring")), "html", null, true);
            echo "
            <span class=\"close\" data-dismiss='alert'>&times;</span>
        </div>
        ";
        }
        // line 37
        echo "        ";
        if (call_user_func_array($this->env->getFunction('session_has')->getCallable(), array("info"))) {
            // line 38
            echo "        <div class=\"alert alert-info center-block text-center\">
            ";
            // line 39
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('session_flash')->getCallable(), array("info")), "html", null, true);
            echo "
            <span class=\"close\" data-dismiss='alert'>&times;</span>
        </div>
        ";
        }
        // line 43
        echo "        ";
        $this->displayBlock('body', $context, $blocks);
        // line 44
        echo "        <footer class=\"footer\">
            <div class=\"container-fluid\">
                <nav class=\"pull-left\">
                    <ul>
                        <li>
                            <a href=\"";
        // line 49
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
        // line 61
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_app')->getCallable(), array()), "html", null, true);
        echo "\">Zakaa</a>, made with love for a better web
                </p>
            </div>
        </footer>
    </div>
</div>
";
        // line 67
        $this->displayBlock('modals', $context, $blocks);
        // line 68
        echo "
<script src=\"";
        // line 69
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_pub')->getCallable(), array("admin/js/jquery-1.12.1.min.js")), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 70
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_pub')->getCallable(), array("admin/js/bootstrap.min.js")), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 71
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_pub')->getCallable(), array("admin/js/plugins.js")), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 72
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_pub')->getCallable(), array("admin/js/jquery.nicescroll.js")), "html", null, true);
        echo "\"></script>

";
        // line 74
        $this->displayBlock('scripts', $context, $blocks);
        // line 75
        echo "</body>
</html>









";
    }

    // line 15
    public function block_styles($context, array $blocks = array())
    {
    }

    // line 43
    public function block_body($context, array $blocks = array())
    {
    }

    // line 67
    public function block_modals($context, array $blocks = array())
    {
    }

    // line 74
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
        return array (  203 => 74,  198 => 67,  193 => 43,  188 => 15,  173 => 75,  171 => 74,  166 => 72,  162 => 71,  158 => 70,  154 => 69,  151 => 68,  149 => 67,  140 => 61,  125 => 49,  118 => 44,  115 => 43,  108 => 39,  105 => 38,  102 => 37,  95 => 33,  92 => 32,  89 => 31,  82 => 27,  79 => 26,  76 => 25,  69 => 21,  66 => 20,  64 => 19,  59 => 16,  57 => 15,  52 => 13,  48 => 12,  44 => 11,  40 => 10,  36 => 9,  28 => 3,  26 => 2,  23 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* {% set data = session_flash('data') %}*/
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
/*         {% if session_has('success') %}*/
/*         <div class="alert alert-success center-block text-center">*/
/*             {{ session_flash('success') }}*/
/*             <span class="close" data-dismiss='alert'>&times;</span>*/
/*         </div>*/
/*         {% endif %}*/
/*         {% if session_has('error') %}*/
/*         <div class="alert alert-danger center-block text-center">*/
/*             {{ session_flash('error') }}*/
/*             <span class="close" data-dismiss='alert'>&times;</span>*/
/*         </div>*/
/*         {% endif %}*/
/*         {% if session_has('waring') %}*/
/*         <div class="alert alert-waring center-block text-center">*/
/*             {{ session_flash('waring') }}*/
/*             <span class="close" data-dismiss='alert'>&times;</span>*/
/*         </div>*/
/*         {% endif %}*/
/*         {% if session_has('info') %}*/
/*         <div class="alert alert-info center-block text-center">*/
/*             {{ session_flash('info') }}*/
/*             <span class="close" data-dismiss='alert'>&times;</span>*/
/*         </div>*/
/*         {% endif %}*/
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
