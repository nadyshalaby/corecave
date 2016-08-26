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
        echo "

<div class=\"row body\">
    <div class=\"col-lg-6 col-lg-offset-3\">
        <div class= \"head text-capitalize text-center\">
            <p>welcome home! </p>
        </div>
    </div>
    <div class=\"col-lg-6 col-lg-offset-3\">
        <div class=\"main\">
            <h1>we care from your hearts! </h1>
        </div>
    </div>
    <div class=\"center\">
        <div class=\"col-md-6 col-md-offset-3 contact\">
            <form role=\"form\" action=\"";
        // line 19
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_route')->getCallable(), array("auth.signin")), "html", null, true);
        echo "\" method=\"post\">
                <div class=\"row\">
                    <div class=\"col-md-12\">
                        <div class=\"form-group input-group col-xs-12 floating-label-form-group ";
        // line 22
        echo (($this->getAttribute((isset($context["errors"]) ? $context["errors"] : null), "hasError", array(0 => "email"), "method")) ? ("has-error") : (""));
        echo "\">
                            <span class=\"input-group-addon\"> <i class=\"fa fa-envelope-o fa-lg\"></i> </span>
                            <label for=\"email\">Email</label>
                            <input class=\"form-control\" type=\"email\" name=\"email\" id=\"email\" value=\"";
        // line 25
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : null), "email", array()), "html", null, true);
        echo "\" placeholder=\"Email\">
                            ";
        // line 26
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["errors"]) ? $context["errors"] : null), "getError", array(0 => "email"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
            if ($this->getAttribute((isset($context["errors"]) ? $context["errors"] : null), "hasError", array(0 => "email"), "method")) {
                // line 27
                echo "                            <span class=\"help-block\"> ";
                echo twig_escape_filter($this->env, $context["error"], "html", null, true);
                echo " </span>
                            ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 29
        echo "                        </div>
                        <div class=\"form-group input-group col-xs-12 floating-label-form-group ";
        // line 30
        echo (($this->getAttribute((isset($context["errors"]) ? $context["errors"] : null), "hasError", array(0 => "password"), "method")) ? ("has-error") : (""));
        echo " \">
                            <span class=\"input-group-addon\"> <i class=\"fa fa-lock fa-lg\"></i> </span>

                            <label for=\"pass\">Password</label>

                            <input class=\"form-control\" type=\"password\" name=\"password\" id=\"pass\" placeholder=\"Password\">
                            ";
        // line 36
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["errors"]) ? $context["errors"] : null), "getError", array(0 => "password"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
            if ($this->getAttribute((isset($context["errors"]) ? $context["errors"] : null), "hasError", array(0 => "password"), "method")) {
                // line 37
                echo "                            <span class=\"help-block\"> ";
                echo twig_escape_filter($this->env, $context["error"], "html", null, true);
                echo " </span>
                            ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 39
        echo "                        </div>
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
        // line 51
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
        return array (  120 => 51,  106 => 39,  96 => 37,  91 => 36,  82 => 30,  79 => 29,  69 => 27,  64 => 26,  60 => 25,  54 => 22,  48 => 19,  31 => 4,  28 => 3,  11 => 1,);
    }
}
/* {% extends 'admin/default.html '%}*/
/* */
/* {% block body %}*/
/* */
/* */
/* <div class="row body">*/
/*     <div class="col-lg-6 col-lg-offset-3">*/
/*         <div class= "head text-capitalize text-center">*/
/*             <p>welcome home! </p>*/
/*         </div>*/
/*     </div>*/
/*     <div class="col-lg-6 col-lg-offset-3">*/
/*         <div class="main">*/
/*             <h1>we care from your hearts! </h1>*/
/*         </div>*/
/*     </div>*/
/*     <div class="center">*/
/*         <div class="col-md-6 col-md-offset-3 contact">*/
/*             <form role="form" action="{{ url_route('auth.signin') }}" method="post">*/
/*                 <div class="row">*/
/*                     <div class="col-md-12">*/
/*                         <div class="form-group input-group col-xs-12 floating-label-form-group {{errors.hasError('email') ? 'has-error' : ''}}">*/
/*                             <span class="input-group-addon"> <i class="fa fa-envelope-o fa-lg"></i> </span>*/
/*                             <label for="email">Email</label>*/
/*                             <input class="form-control" type="email" name="email" id="email" value="{{ data.email }}" placeholder="Email">*/
/*                             {% for error in errors.getError('email') if errors.hasError('email') %}*/
/*                             <span class="help-block"> {{ error }} </span>*/
/*                             {% endfor %}*/
/*                         </div>*/
/*                         <div class="form-group input-group col-xs-12 floating-label-form-group {{errors.hasError('password') ? 'has-error' : ''}} ">*/
/*                             <span class="input-group-addon"> <i class="fa fa-lock fa-lg"></i> </span>*/
/* */
/*                             <label for="pass">Password</label>*/
/* */
/*                             <input class="form-control" type="password" name="password" id="pass" placeholder="Password">*/
/*                             {% for error in errors.getError('password') if errors.hasError('password') %}*/
/*                             <span class="help-block"> {{ error }} </span>*/
/*                             {% endfor %}*/
/*                         </div>*/
/*                         <div class="checkbox">*/
/*                             <label>*/
/*                                 <input type="checkbox" name='remember'> Remember me...*/
/*                             </label>*/
/*                         </div>*/
/*                         <br>*/
/*                         <div class="form-group">*/
/*                             <button type="submit" class="btn btn-default btn-lg">Login</button>*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*                 {{ token_input()|raw }}*/
/*             </form>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* {% endblock %}*/
