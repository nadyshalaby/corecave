<?php

/* admin/pages/dashboard.html */
class __TwigTemplate_e06734f826026c51268f255138bd0a8f4cd8540f2cc3bb3ff13af3a583f1a23b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("admin/master.html ", "admin/pages/dashboard.html", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "admin/master.html ";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "<section class=\"panel panel-default content\">
    <div class=\"panel-heading\">
        <h3 class=\"panel-head\">Dashboard</h3>
    </div>
    <div class=\"panel-body\">
        <div class=\"container-fluid\">
            <div class=\"row\">
                <div class=\"col-lg-7 col-md-7 \">
                    <div class=\"panel panel-success\">
                        <div class=\"panel-heading\">
                            <h3 class=\"panel-title\">Activity Status</h3>
                        </div>
                        <div class=\"panel-body\">
                            content
                        </div>
                        <div class=\"panel-footer\">Panel footer</div>
                    </div>
                </div>
                <div class=\"col-lg-5 col-md-5\">
                    <div class=\"panel panel-success\">
                        <div class=\"panel-heading\">
                            <h3 class=\"panel-title\">Daily Spotlight</h3>
                        </div>
                        <div class=\"panel-body\">
                            content
                        </div>
                        <div class=\"panel-footer\">Panel footer</div>
                    </div>
                </div>
            </div>
            <div class=\"row\">
                <div class=\"col-lg-7 col-md-7 \">
                    <div class=\"panel panel-success\">
                        <div class=\"panel-heading\">
                            <h3 class=\"panel-title\">Mony In Egypt</h3>
                        </div>
                        <div class=\"panel-body\">
                            Panel content
                        </div>
                        <div class=\"panel-footer\">Panel footer</div>
                    </div>
                </div>
                <div class=\"col-lg-5 col-md-5\">
                    <div class=\"panel panel-success\">
                        <div class=\"panel-heading\">
                            <h3 class=\"panel-title\">Highest 5 Invoices</h3>
                        </div>
                        <div class=\"panel-body\">
                            Panel content
                        </div>
                        <div class=\"panel-footer\">Panel footer</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
";
    }

    public function getTemplateName()
    {
        return "admin/pages/dashboard.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  31 => 4,  28 => 3,  11 => 1,);
    }
}
/* {% extends 'admin/master.html '%}*/
/* */
/* {% block content %}*/
/* <section class="panel panel-default content">*/
/*     <div class="panel-heading">*/
/*         <h3 class="panel-head">Dashboard</h3>*/
/*     </div>*/
/*     <div class="panel-body">*/
/*         <div class="container-fluid">*/
/*             <div class="row">*/
/*                 <div class="col-lg-7 col-md-7 ">*/
/*                     <div class="panel panel-success">*/
/*                         <div class="panel-heading">*/
/*                             <h3 class="panel-title">Activity Status</h3>*/
/*                         </div>*/
/*                         <div class="panel-body">*/
/*                             content*/
/*                         </div>*/
/*                         <div class="panel-footer">Panel footer</div>*/
/*                     </div>*/
/*                 </div>*/
/*                 <div class="col-lg-5 col-md-5">*/
/*                     <div class="panel panel-success">*/
/*                         <div class="panel-heading">*/
/*                             <h3 class="panel-title">Daily Spotlight</h3>*/
/*                         </div>*/
/*                         <div class="panel-body">*/
/*                             content*/
/*                         </div>*/
/*                         <div class="panel-footer">Panel footer</div>*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/*             <div class="row">*/
/*                 <div class="col-lg-7 col-md-7 ">*/
/*                     <div class="panel panel-success">*/
/*                         <div class="panel-heading">*/
/*                             <h3 class="panel-title">Mony In Egypt</h3>*/
/*                         </div>*/
/*                         <div class="panel-body">*/
/*                             Panel content*/
/*                         </div>*/
/*                         <div class="panel-footer">Panel footer</div>*/
/*                     </div>*/
/*                 </div>*/
/*                 <div class="col-lg-5 col-md-5">*/
/*                     <div class="panel panel-success">*/
/*                         <div class="panel-heading">*/
/*                             <h3 class="panel-title">Highest 5 Invoices</h3>*/
/*                         </div>*/
/*                         <div class="panel-body">*/
/*                             Panel content*/
/*                         </div>*/
/*                         <div class="panel-footer">Panel footer</div>*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/* */
/*         </div>*/
/*     </div>*/
/* </section>*/
/* {% endblock %}*/
