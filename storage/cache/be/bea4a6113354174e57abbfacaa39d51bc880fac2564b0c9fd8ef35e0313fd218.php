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

<html lang=\"en\">
    <head>
        <meta charset=\"UTF-8\"/>
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <meta name=\"csrf\" content=\"";
        // line 7
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('token_csrf')->getCallable(), array()), "html", null, true);
        echo "\">
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
        <link rel='stylesheet' href=\"";
        // line 14
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_pub')->getCallable(), array("admin/css/animate.min.css")), "html", null, true);
        echo "\"/>
        <link rel='stylesheet' href=\"";
        // line 15
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_pub')->getCallable(), array("site/css/sweetalert.css")), "html", null, true);
        echo "\"/>
        <link rel='stylesheet' href=\"http://fonts.googleapis.com/css?family=Roboto:400,700,300\"/>
        ";
        // line 17
        $this->displayBlock('styles', $context, $blocks);
        // line 18
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
        echo "<form id=\"csrf\">";
        echo call_user_func_array($this->env->getFunction('token_input')->getCallable(), array());
        echo "</form>
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
<script src=\"";
        // line 51
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_pub')->getCallable(), array("site/js/sweetalert.min.js")), "html", null, true);
        echo "\"></script>
<script>
";
        // line 53
        if ($this->getAttribute((isset($context["errors"]) ? $context["errors"] : null), "hasError", array(), "method")) {
            // line 54
            echo "swal({title: \"Error!\", text: '";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('getErrors')->getCallable(), array()), "html", null, true);
            echo "', type: \"error\", confirmButtonText: \"close\"});
";
        }
        // line 56
        if (call_user_func_array($this->env->getFunction('session_has')->getCallable(), array("success"))) {
            // line 57
            echo "swal(\"Good job!\", \"";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('session_pull')->getCallable(), array("success")), "html", null, true);
            echo "\", \"success\")
";
        }
        // line 59
        if (call_user_func_array($this->env->getFunction('session_has')->getCallable(), array("error"))) {
            // line 60
            echo "swal(\"Error!\", \"";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('session_pull')->getCallable(), array("error")), "html", null, true);
            echo "\", \"error\")
";
        }
        // line 62
        if (call_user_func_array($this->env->getFunction('session_has')->getCallable(), array("warning"))) {
            // line 63
            echo "swal(\"Sorry!\", \"";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('session_pull')->getCallable(), array("warning")), "html", null, true);
            echo "\", \"warning\")
";
        }
        // line 65
        if (call_user_func_array($this->env->getFunction('session_has')->getCallable(), array("info"))) {
            // line 66
            echo "swal(\"Information!\", \"";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('session_pull')->getCallable(), array("info")), "html", null, true);
            echo "\", \"info\")
";
        }
        // line 68
        echo "</script>

";
        // line 70
        $this->displayBlock('scripts', $context, $blocks);
        // line 71
        echo "</body>
</html>









";
    }

    // line 17
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

    // line 70
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
        return array (  209 => 70,  204 => 45,  199 => 21,  194 => 17,  179 => 71,  177 => 70,  173 => 68,  167 => 66,  165 => 65,  159 => 63,  157 => 62,  151 => 60,  149 => 59,  143 => 57,  141 => 56,  135 => 54,  133 => 53,  128 => 51,  124 => 50,  120 => 49,  116 => 48,  112 => 47,  107 => 46,  105 => 45,  96 => 39,  81 => 27,  74 => 22,  72 => 21,  67 => 18,  65 => 17,  60 => 15,  56 => 14,  52 => 13,  48 => 12,  44 => 11,  40 => 10,  36 => 9,  31 => 7,  23 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* */
/* <html lang="en">*/
/*     <head>*/
/*         <meta charset="UTF-8"/>*/
/*         <meta name="viewport" content="width=device-width, initial-scale=1">*/
/*         <meta name="csrf" content="{{ token_csrf() }}">*/
/*         <title>Our First Hand</title>*/
/*         <link rel='stylesheet' href="{{ url_pub('admin/css/bootstrap.min.css') }}" />*/
/*         <link rel='stylesheet' href="{{ url_pub('admin/css/style.css') }}"/>*/
/*         <link rel='stylesheet' href="{{ url_pub('admin/css/font-awesome.min.css') }}"/>*/
/*         <link rel='stylesheet' href="{{ url_pub('admin/css/media.css') }}"/>*/
/*         <link rel='stylesheet' href="{{ url_pub('admin/css/animate.min.css') }}"/>*/
/*         <link rel='stylesheet' href="{{ url_pub('admin/css/animate.min.css') }}"/>*/
/*         <link rel='stylesheet' href="{{ url_pub('site/css/sweetalert.css') }}"/>*/
/*         <link rel='stylesheet' href="http://fonts.googleapis.com/css?family=Roboto:400,700,300"/>*/
/*         {% block styles %}{% endblock %}*/
/*     </head>*/
/* */
/*     <body>*/
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
/* <form id="csrf">{{ token_input() |raw}}</form>*/
/* <script src="{{ url_pub('admin/js/jquery-1.12.1.min.js') }}"></script>*/
/* <script src="{{ url_pub('admin/js/bootstrap.min.js') }}"></script>*/
/* <script src="{{ url_pub('admin/js/plugins.js') }}"></script>*/
/* <script src="{{ url_pub('admin/js/jquery.nicescroll.js') }}"></script>*/
/* <script src="{{ url_pub('site/js/sweetalert.min.js') }}"></script>*/
/* <script>*/
/* {% if errors.hasError() %}*/
/* swal({title: "Error!", text: '{{ getErrors() }}', type: "error", confirmButtonText: "close"});*/
/* {% endif %}*/
/* {% if session_has('success') %}*/
/* swal("Good job!", "{{ session_pull('success') }}", "success")*/
/* {% endif %}*/
/* {% if session_has('error') %}*/
/* swal("Error!", "{{ session_pull('error') }}", "error")*/
/* {% endif %}*/
/* {% if session_has('warning') %}*/
/* swal("Sorry!", "{{ session_pull('warning') }}", "warning")*/
/* {% endif %}*/
/* {% if session_has('info') %}*/
/* swal("Information!", "{{ session_pull('info') }}", "info")*/
/* {% endif %}*/
/* </script>*/
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
