<?php

/* admin/master.html  */
class __TwigTemplate_c257b59a1855d27ddb6b6f6e42170d7da4687234e083175f1c700b653a601687 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("admin/default.html ", "admin/master.html ", 1);
        $this->blocks = array(
            'body' => array($this, 'block_body'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "admin/default.html ";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        // line 4
        echo "        <div class=\"wrapper\">
            <div class=\"sidebar\" data-image=\"";
        // line 5
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_pub')->getCallable(), array("admin/images/bg1.png")), "html", null, true);
        echo "\">
                <div class=\"sidebar-wrapper\">
                    <div class=\"logo\">
                        <a href=\"";
        // line 8
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_route')->getCallable(), array("home")), "html", null, true);
        echo "\" class=\"simple-text\">
                            <i class=\"fa fa-lightbulb-o\"></i>
                            <span>Zakaa</span> .inc
                        </a>
                    </div>
                    <ul class=\"nav side\">
                        <li>
                            <a href=\"";
        // line 15
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_route')->getCallable(), array("home")), "html", null, true);
        echo "\">
                                <i class=\"fa fa-dashboard\"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li>
                            <a href=\"";
        // line 21
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_route')->getCallable(), array("orders")), "html", null, true);
        echo "\">
                                <i class=\"fa fa-volume-control-phone\"></i>
                                <p>Orders</p>
                            </a>
                        </li>
                        <li>
                            <a href=\"";
        // line 27
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_route')->getCallable(), array("messages")), "html", null, true);
        echo "\">
                                <i class=\"fa fa-envelope icon\"></i>
                                <p>Messages</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class=\"main-panel\">
                <nav class=\"navbar navbar-default navbar-fixed\">
                    <div class=\"container-fluid\">
                        <div class=\"navbar-header\">
                            <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#my-navbar\">
                                <span class=\"sr-only\">Toggle navigation</span>
                                <span class=\"icon-bar\"></span>
                                <span class=\"icon-bar\"></span>
                                <span class=\"icon-bar\"></span>
                            </button>
                            <a href=\"";
        // line 46
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_app')->getCallable(), array()), "html", null, true);
        echo "\" class=\"navbar-brand\">
                                <i class=\"fa fa-home\"></i>
                                Home
                            </a>
                        </div>
                        <div class=\"collapse navbar-collapse\" >
<!--                            <ul class=\"nav navbar-nav navbar-left\">

                                <li class=\"dropdown\">
                                    <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">
                                        <i class=\"fa fa-globe\"></i>
                                        <b class=\"caret\"></b>
                                        <span class=\"notification\">5</span>
                                    </a>
                                    <ul class=\"dropdown-menu\">
                                        <li><a href=\"#\">Notification 1</a></li>
                                        <li><a href=\"#\">Notification 2</a></li>
                                        <li><a href=\"#\">Notification 3</a></li>
                                        <li><a href=\"#\">Another notification</a></li>
                                    </ul>
                                </li>
                                <li class=\"hidden-xs hidden-sm ser\">
                                    <a href=\"#\">
                                        <i class=\"fa fa-search\"></i>
                                    </a>
                                </li>
                                <form class=\"navbar-form navbar-left\" role=\"search\">
                                    <div class=\"form-group\">
                                        <input type=\"text\" class=\"form-control\" placeholder=\"Search\">
                                    </div>
                                    <button type=\"submit\" class=\"btn btn-danger\">Search</button>
                                </form>
                            </ul>-->
                            <ul class=\"nav navbar-nav navbar-right\">
                                <li class=\"dropdown\">
                                    <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">
                                        <span><i class=\"fa fa-user\"></i></span> ";
        // line 82
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["auth"]) ? $context["auth"] : null), "getUser", array()), "fullname", array()), "html", null, true);
        echo "
                                        <b class=\"caret\"></b>
                                    </a>
                                    <ul class=\"dropdown-menu\">
                                        <li><a href=\"";
        // line 86
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_route')->getCallable(), array("profile")), "html", null, true);
        echo "\">Profile</a></li>
                                        <li><a href=\"";
        // line 87
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_route')->getCallable(), array("logout")), "html", null, true);
        echo "\">Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <ol class=\"breadcrumb\">
                    <li><a href=\"#\"><i class=\"fa fa-home\"></i>Home Page</a></li>
                    <li  class=\"active\"><a href=\"qutations.html\">Incoming Orders</a></li>
                </ol>

                ";
        // line 99
        $this->displayBlock('content', $context, $blocks);
        // line 100
        echo "
                <footer class=\"footer\">
                    <div class=\"container-fluid\">
                        <nav class=\"pull-left\">
                            <ul>
                                <li>
                                    <a href=\"";
        // line 106
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
        // line 118
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_app')->getCallable(), array()), "html", null, true);
        echo "\">Zakaa</a>, made with love for a better web
                        </p>
                    </div>
                </footer>
            </div>
        </div>

";
    }

    // line 99
    public function block_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "admin/master.html ";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  193 => 99,  181 => 118,  166 => 106,  158 => 100,  156 => 99,  141 => 87,  137 => 86,  130 => 82,  91 => 46,  69 => 27,  60 => 21,  51 => 15,  41 => 8,  35 => 5,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends 'admin/default.html '%}*/
/* */
/* {% block body %}*/
/*         <div class="wrapper">*/
/*             <div class="sidebar" data-image="{{ url_pub('admin/images/bg1.png') }}">*/
/*                 <div class="sidebar-wrapper">*/
/*                     <div class="logo">*/
/*                         <a href="{{ url_route('home') }}" class="simple-text">*/
/*                             <i class="fa fa-lightbulb-o"></i>*/
/*                             <span>Zakaa</span> .inc*/
/*                         </a>*/
/*                     </div>*/
/*                     <ul class="nav side">*/
/*                         <li>*/
/*                             <a href="{{ url_route('home') }}">*/
/*                                 <i class="fa fa-dashboard"></i>*/
/*                                 <p>Dashboard</p>*/
/*                             </a>*/
/*                         </li>*/
/*                         <li>*/
/*                             <a href="{{ url_route('orders') }}">*/
/*                                 <i class="fa fa-volume-control-phone"></i>*/
/*                                 <p>Orders</p>*/
/*                             </a>*/
/*                         </li>*/
/*                         <li>*/
/*                             <a href="{{ url_route('messages') }}">*/
/*                                 <i class="fa fa-envelope icon"></i>*/
/*                                 <p>Messages</p>*/
/*                             </a>*/
/*                         </li>*/
/*                     </ul>*/
/*                 </div>*/
/*             </div>*/
/* */
/*             <div class="main-panel">*/
/*                 <nav class="navbar navbar-default navbar-fixed">*/
/*                     <div class="container-fluid">*/
/*                         <div class="navbar-header">*/
/*                             <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#my-navbar">*/
/*                                 <span class="sr-only">Toggle navigation</span>*/
/*                                 <span class="icon-bar"></span>*/
/*                                 <span class="icon-bar"></span>*/
/*                                 <span class="icon-bar"></span>*/
/*                             </button>*/
/*                             <a href="{{ url_app() }}" class="navbar-brand">*/
/*                                 <i class="fa fa-home"></i>*/
/*                                 Home*/
/*                             </a>*/
/*                         </div>*/
/*                         <div class="collapse navbar-collapse" >*/
/* <!--                            <ul class="nav navbar-nav navbar-left">*/
/* */
/*                                 <li class="dropdown">*/
/*                                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">*/
/*                                         <i class="fa fa-globe"></i>*/
/*                                         <b class="caret"></b>*/
/*                                         <span class="notification">5</span>*/
/*                                     </a>*/
/*                                     <ul class="dropdown-menu">*/
/*                                         <li><a href="#">Notification 1</a></li>*/
/*                                         <li><a href="#">Notification 2</a></li>*/
/*                                         <li><a href="#">Notification 3</a></li>*/
/*                                         <li><a href="#">Another notification</a></li>*/
/*                                     </ul>*/
/*                                 </li>*/
/*                                 <li class="hidden-xs hidden-sm ser">*/
/*                                     <a href="#">*/
/*                                         <i class="fa fa-search"></i>*/
/*                                     </a>*/
/*                                 </li>*/
/*                                 <form class="navbar-form navbar-left" role="search">*/
/*                                     <div class="form-group">*/
/*                                         <input type="text" class="form-control" placeholder="Search">*/
/*                                     </div>*/
/*                                     <button type="submit" class="btn btn-danger">Search</button>*/
/*                                 </form>*/
/*                             </ul>-->*/
/*                             <ul class="nav navbar-nav navbar-right">*/
/*                                 <li class="dropdown">*/
/*                                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">*/
/*                                         <span><i class="fa fa-user"></i></span> {{ auth.getUser.fullname }}*/
/*                                         <b class="caret"></b>*/
/*                                     </a>*/
/*                                     <ul class="dropdown-menu">*/
/*                                         <li><a href="{{ url_route('profile') }}">Profile</a></li>*/
/*                                         <li><a href="{{ url_route('logout') }}">Logout</a></li>*/
/*                                     </ul>*/
/*                                 </li>*/
/*                             </ul>*/
/*                         </div>*/
/*                     </div>*/
/*                 </nav>*/
/*                 <ol class="breadcrumb">*/
/*                     <li><a href="#"><i class="fa fa-home"></i>Home Page</a></li>*/
/*                     <li  class="active"><a href="qutations.html">Incoming Orders</a></li>*/
/*                 </ol>*/
/* */
/*                 {% block content %}{% endblock %}*/
/* */
/*                 <footer class="footer">*/
/*                     <div class="container-fluid">*/
/*                         <nav class="pull-left">*/
/*                             <ul>*/
/*                                 <li>*/
/*                                     <a href="{{ url_app() }}">*/
/*                                         Home*/
/*                                     </a>*/
/*                                 </li>*/
/*                                 <li>*/
/*                                     <a href="#">*/
/*                                         Company*/
/*                                     </a>*/
/*                                 </li>*/
/*                             </ul>*/
/*                         </nav>*/
/*                         <p class="copyright pull-right">*/
/*                             &copy; 2016 <a href="{{ url_app() }}">Zakaa</a>, made with love for a better web*/
/*                         </p>*/
/*                     </div>*/
/*                 </footer>*/
/*             </div>*/
/*         </div>*/
/* */
/* {% endblock %}*/
/* */
/* */
/* */
/* */
/* */
/* */
/* */
/* */
/* */
