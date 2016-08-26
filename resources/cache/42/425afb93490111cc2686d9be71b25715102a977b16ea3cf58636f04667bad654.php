<?php

/* admin/pages/login.html */
class __TwigTemplate_083cd1776cfcfc4cf496040e03798474e32403b0187a9fe9ab9c7cc0b6433318 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("admin/default.html ", "admin/pages/login.html", 1);
        $this->blocks = array(
            'body' => array($this, 'block_body'),
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
        echo "<div class=\"row body\">
    <div class=\"col-lg-6 col-lg-offset-3\">
        <div class= \"head text-capitalize text-center\">
            <p>welcom home! </p>
        </div>
    </div>
    <div class=\"col-lg-6 col-lg-offset-3\">
        <div class=\"main\">
            <h1>we care from your hearts! <h1>
                    </div>
                    </div>
                    <div class=\"center\">
                        <div class=\"col-md-6 col-md-offset-3 contact\">
                            <form role=\"form\" action=\"";
        // line 17
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_route')->getCallable(), array("sign-in")), "html", null, true);
        echo "\" method=\"post\">

                                <div class=\"row\">
                                    <div class=\"col-md-12\">
                                        <div class=\"form-group input-group col-xs-12 floating-label-form-group\">
                                            <span class=\"input-group-addon\"> <i class=\"fa fa-envelope-o fa-lg\"></i> </span>
                                            <label for=\"email\">Email</label>
                                            <input class=\"form-control\" type=\"email\" name=\"email\" id=\"email\" value=\"";
        // line 24
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : null), "email", array()), "html", null, true);
        echo "\" placeholder=\"Email\">
                                        </div>
                                        <div class=\"form-group input-group col-xs-12 floating-label-form-group\">
                                            <span class=\"input-group-addon\"> <i class=\"fa fa-lock fa-lg\"></i> </span>

                                            <label for=\"pass\">Password</label>

                                            <input class=\"form-control\" type=\"password\" name=\"pass\" id=\"pass\" placeholder=\"Password\">
                                        </div>
                                        <div class=\"checkbox\">
                                            <label>
                                                <input type=\"checkbox\" name='remember'> Remember me...
                                            </label>
                                        </div>
                                        <br>
                                        <div class=\"form-group\">
                                            <button type=\"submit\" class=\"btn btn-default btn-lg\">Login</button>
                                        </div>
                                    </div>
                                </div>
                                ";
        // line 44
        echo call_user_func_array($this->env->getFunction('token_input')->getCallable(), array());
        echo "
                            </form>
                        </div>
                    </div>
                    </div>
";
    }

    public function getTemplateName()
    {
        return "admin/pages/login.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  79 => 44,  56 => 24,  46 => 17,  31 => 4,  28 => 3,  11 => 1,);
    }
}
/* {% extends 'admin/default.html '%}*/
/* */
/* {% block body %}*/
/* <div class="row body">*/
/*     <div class="col-lg-6 col-lg-offset-3">*/
/*         <div class= "head text-capitalize text-center">*/
/*             <p>welcom home! </p>*/
/*         </div>*/
/*     </div>*/
/*     <div class="col-lg-6 col-lg-offset-3">*/
/*         <div class="main">*/
/*             <h1>we care from your hearts! <h1>*/
/*                     </div>*/
/*                     </div>*/
/*                     <div class="center">*/
/*                         <div class="col-md-6 col-md-offset-3 contact">*/
/*                             <form role="form" action="{{ url_route('sign-in') }}" method="post">*/
/* */
/*                                 <div class="row">*/
/*                                     <div class="col-md-12">*/
/*                                         <div class="form-group input-group col-xs-12 floating-label-form-group">*/
/*                                             <span class="input-group-addon"> <i class="fa fa-envelope-o fa-lg"></i> </span>*/
/*                                             <label for="email">Email</label>*/
/*                                             <input class="form-control" type="email" name="email" id="email" value="{{ data.email }}" placeholder="Email">*/
/*                                         </div>*/
/*                                         <div class="form-group input-group col-xs-12 floating-label-form-group">*/
/*                                             <span class="input-group-addon"> <i class="fa fa-lock fa-lg"></i> </span>*/
/* */
/*                                             <label for="pass">Password</label>*/
/* */
/*                                             <input class="form-control" type="password" name="pass" id="pass" placeholder="Password">*/
/*                                         </div>*/
/*                                         <div class="checkbox">*/
/*                                             <label>*/
/*                                                 <input type="checkbox" name='remember'> Remember me...*/
/*                                             </label>*/
/*                                         </div>*/
/*                                         <br>*/
/*                                         <div class="form-group">*/
/*                                             <button type="submit" class="btn btn-default btn-lg">Login</button>*/
/*                                         </div>*/
/*                                     </div>*/
/*                                 </div>*/
/*                                 {{ token_input()|raw }}*/
/*                             </form>*/
/*                         </div>*/
/*                     </div>*/
/*                     </div>*/
/* {% endblock %}*/
