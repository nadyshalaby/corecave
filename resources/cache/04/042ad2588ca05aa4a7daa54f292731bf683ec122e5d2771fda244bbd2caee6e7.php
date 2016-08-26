<?php

/* admin/pages/orders.html */
class __TwigTemplate_7821daecd19050bd6d561d7bbc87bfc2a03cdd06440d75643b8ba199ad4c7dbd extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("admin/master.html ", "admin/pages/orders.html", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
            'modals' => array($this, 'block_modals'),
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
        echo "<section class=\"content\">
    <div class=\"panel panel-default\">
        <div class=\"panel-heading\">
            <h3 class=\"panel-head\">Incoming Orders</h3>
        </div>
        <div class=\"panel-body\">
            <div class=\"container-fluid\">
                <div class=\"row top-table\">
                    <div class=\"col-xs-7\">

                        <div class=\"col-xs-5 inner-col\">
                            <div class=\"btn-group\" data-toggle=\"buttons\">
                                <label class=\"btn btn-sm btn-default  active\" title=\"All Plane Type\">
                                    <input type=\"radio\" name=\"options\" id=\"\" autocomplete=\"off\" checked>
                                    <i class=\"fa text-active\"></i>
                                    All
                                </label>
                                <label class=\"btn btn-sm btn-default\" title=\"Basic Plane\">
                                    <input type=\"radio\" name=\"options\" id=\"\" autocomplete=\"off\" > 
                                    <i class=\"fa text-active\"></i>
                                    Basic
                                </label>
                                <label class=\"btn btn-sm btn-default\" title=\"Pro Plane\">
                                    <input type=\"radio\" name=\"options\" id=\"\" autocomplete=\"off\">
                                    <i class=\"fa text-active\"></i>
                                    Pro
                                </label>
                                <label class=\"btn btn-sm btn-default\" title=\"Economic Plane\">
                                    <input type=\"radio\" name=\"options\" id=\"\" autocomplete=\"off\">
                                    <i class=\"fa text-active\"></i>
                                    Eco
                                </label>
                                <label class=\"btn btn-sm btn-default\" title=\"Enterprise Plane\">
                                    <input type=\"radio\" name=\"options\" id=\"\" autocomplete=\"off\">
                                    <i class=\"fa text-active\"></i>
                                    Custom
                                </label>
                            </div>
                        </div>

                        <div class=\"col-xs-4 inner-col\">
                            <div class=\"btn-group\" data-toggle=\"buttons\">
                                <label class=\"btn btn-sm btn-default  active\" title=\"All Orders\" >
                                    <input type=\"radio\" name=\"options\" id=\"\" autocomplete=\"off\" checked>
                                    <i class=\"fa text-active \"></i>
                                    All
                                </label>
                                <label class=\"btn btn-sm btn-default\" title=\"Accepted Orders\">
                                    <input type=\"radio\" name=\"options\" id=\"\" autocomplete=\"off\" > 
                                    <i class=\"fa fa-thumbs-up text-success\"></i>

                                </label>
                                <label class=\"btn btn-sm btn-default\" title=\"Rejected Orders\">
                                    <input type=\"radio\" name=\"options\" id=\"\" autocomplete=\"off\" >
                                    <i class=\"fa fa-thumbs-down text-danger\"></i>

                                </label>
                                <label class=\"btn btn-sm btn-default\" title=\"Todayes Orders\">
                                    <input type=\"radio\" name=\"options\" id=\"\" autocomplete=\"off\" >
                                    <i class=\"fa fa-bell \"></i>

                                </label>
                                <label class=\"btn btn-sm btn-default\" title=\"Viewed Orders\">
                                    <input type=\"radio\" name=\"options\" id=\"\" autocomplete=\"off\" >
                                    <i class=\"fa fa-eye text-primary\"></i>

                                </label>
                                <label class=\"btn btn-sm btn-default\" title=\"Unviewed Orders\">
                                    <input type=\"radio\" name=\"options\" id=\"\" autocomplete=\"off\" >
                                    <i class=\"fa fa-eye-slash text-danger\"></i>

                                </label>
                            </div>
                        </div>

                        <!--
                                                    <div class=\"col-xs-2\">
                                                        <div class=\"btn-group\">
                                                          <button type=\"button\" class=\"btn btn-default btn-sm dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                                                            <span class=\"dropdown-label\">ACCEPTED</span>
                                                            <span class=\"caret\"></span>
                                                          </button>
                                                          <ul class=\"dropdown-menu dropdown-select\">
                                                            <li><a href=\"#\"><input type=\"radio\" name=\"select\">ALL STAGES </a></li>
                                                            <li><a href=\"#\"><input type=\"radio\" name=\"select\">CREATED </a></li>
                                                            <li><a href=\"#\"><input type=\"radio\" name=\"select\">SENT </a></li>
                                                            <li><a href=\"#\"><input type=\"radio\" name=\"select\">DRAFT</a></li>
                                                            <li><a href=\"#\"><input type=\"radio\" name=\"select\">ACCEPTED</a></li>
                                                            <li><a href=\"#\"><input type=\"radio\" name=\"select\">DECLINED</a></li>
                                                          </ul>
                                                        </div>
                                                    </div>
                        -->
                        <!--
                                                    <div class=\"col-xs-2\">
                                                        <div class=\"btn-group\" data-toggle=\"buttons\">
                                                            <label class=\"btn btn-sm btn-primary\">
                                                                <input type=\"checkbox\" name=\"options\" id=\"\" autocomplete=\"off\" checked>
                                                                <i class=\"fa fa-filter\"></i>
                                                                    Filter
                                                            </label>   
                                                        </div>
                                                    </div>
                        -->

                    </div>

                    <div class=\"ser-a-del col-xs-5\">


                        <!--
                                                    <button type=\"button\" class=\"btn btn-danger btn-sm\" data-toggle=\"modal\" data-target=\"#modal-delete\"> 
                                                            <i class=\"fa fa-trash\"></i>
                                                            Delete
                                                    </button>
                        -->
                        <div class=\"col-xs-8 inner-col\">
                            <div class=\"input-group\">
                                <input type=\"text\" class=\"form-control input-sm\" placeholder=\"Search for...\">
                                <span class=\"input-group-btn\">
                                    <button class=\"btn btn-sm btn-success\" type=\"button\">
                                        <i class=\"fa fa-search\"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class=\"addNew col-xs-4 \">
                            <div class=\"dropdown\">
                                <button class=\"btn btn-default dropdown-toggle\" type=\"button\" id=\"dropdownMenu1\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"true\">
                                    Set As <i class=\"fa fa-cogs text-danger\"></i>
                                    <span class=\"caret\"></span>
                                </button>
                                <ul class=\"dropdown-menu\" aria-labelledby=\"dropdownMenu1\">
                                    <li><a href=\"#\">Accepted &nbsp;<span>    <i class=\"fa fa-thumbs-up text-success\"></i></span></a></li>
                                    <li><a href=\"#\">Rejected &nbsp;<span>    <i class=\"fa fa-thumbs-down text-danger\"></i></span></a></li>
                                    <li><a href=\"#\">Seen  &nbsp;<span><i class=\"fa fa-eye text-primary\"></i></span></a></li>
                                    <li><a href=\"#\">Un Seen  &nbsp;<span><i class=\"fa fa-eye-slash text-danger\"></i></span></a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"table-responsive\">
                        <table class=\"table table-hover table-orders\">
                            <thead>
                                <tr>
                                    <th id=\"ID\">
                                        <input id=\"CheckAll\" type=\"checkbox\">
                                    </th>
                                    <th>Plane Type</th><th>F-Name</th><th>L-Name</th><th>Mobile</th><th>Email</th><th>Country</th><th>State</th><th>Date</th><th>Operation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class=\"\">
                                    <td class=\"ID\">
                                        <input name=\"check\" class=\"chk-box\" id=\"\" value=\"\" type=\"checkbox\">
                                    </td>
                                    <td>Basic Plane</i></td>
                                    <td>Ahmed</i></td>
                                    <td>Mohamed</td>
                                    <td>0123456789</td>
                                    <td>Ahmed@yahoo.com</td>
                                    <td>Egypt</td>
                                    <td>Alexandria</td>
                                    <td><small>17/02/2016</small></td>
                                    <td><button type=\"button\" class=\"btn btn-info btn-sm\" data-toggle=\"modal\" data-target=\"#modal-orders\"> 
                                            <i class=\"fa fa-eye\"></i>
                                            View
                                        </button></td>
                                </tr>
                                <tr class=\"\">
                                    <td class=\"ID\">
                                        <input name=\"check\" class=\"chk-box\" id=\"\" value=\"\" type=\"checkbox\">
                                    </td>
                                    <td>Basic Plane</i></td>
                                    <td>Ahmed</i></td>
                                    <td>Mohamed</td>
                                    <td>0123456789</td>
                                    <td>Ahmed@yahoo.com</td>
                                    <td>Egypt</td>
                                    <td>Alexandria</td>
                                    <td><small>17/02/2016</small></td>
                                    <td><button type=\"button\" class=\"btn btn-info btn-sm\" data-toggle=\"modal\" data-target=\"#modal-orders\"> 
                                            <i class=\"fa fa-eye\"></i>
                                            View
                                        </button></td>
                                </tr>
                                <tr class=\"\">
                                    <td class=\"ID\">
                                        <input name=\"check\" class=\"chk-box\" id=\"\" value=\"\" type=\"checkbox\">
                                    </td>
                                    <td>Basic Plane</i></td>
                                    <td>Ahmed</i></td>
                                    <td>Mohamed</td>
                                    <td>0123456789</td>
                                    <td>Ahmed@yahoo.com</td>
                                    <td>Egypt</td>
                                    <td>Alexandria</td>
                                    <td><small>17/02/2016</small></td>
                                    <td><button type=\"button\" class=\"btn btn-info btn-sm\" data-toggle=\"modal\" data-target=\"#modal-orders\"> 
                                            <i class=\"fa fa-eye\"></i>
                                            View
                                        </button></td>
                                </tr>
                                <tr class=\"rejected\">
                                    <td class=\"ID\">
                                        <input name=\"check\" class=\"chk-box\" id=\"\" value=\"\" type=\"checkbox\">
                                    </td>
                                    <td>Pro Plane</i></td>
                                    <td>Ahmed</i></td>
                                    <td>Mohamed</td>
                                    <td>0123456789</td>
                                    <td>Ahmed@yahoo.com</td>
                                    <td>Egypt</td>
                                    <td>Alexandria</td>
                                    <td><small>17/02/2016</small></td>
                                    <td><button type=\"button\" class=\"btn btn-info btn-sm\" data-toggle=\"modal\" data-target=\"#modal-orders\"> 
                                            <i class=\"fa fa-eye\"></i>
                                            View
                                        </button></td>
                                </tr>
                                <tr class=\"\">
                                    <td class=\"ID\">
                                        <input name=\"check\" class=\"chk-box\" id=\"\" value=\"\" type=\"checkbox\">
                                    </td>
                                    <td>Basic Plane</i></td>
                                    <td>Ahmed</i></td>
                                    <td>Mohamed</td>
                                    <td>0123456789</td>
                                    <td>Ahmed@yahoo.com</td>
                                    <td>Egypt</td>
                                    <td>Alexandria</td>
                                    <td><small>17/02/2016</small></td>
                                    <td><button type=\"button\" class=\"btn btn-info btn-sm\" data-toggle=\"modal\" data-target=\"#modal-orders\"> 
                                            <i class=\"fa fa-eye\"></i>
                                            View
                                        </button></td>
                                </tr>
                                <tr class=\"\">
                                    <td class=\"ID\">
                                        <input name=\"check\" class=\"chk-box\" id=\"\" value=\"\" type=\"checkbox\">
                                    </td>
                                    <td>Basic Plane</i></td>
                                    <td>Ahmed</i></td>
                                    <td>Mohamed</td>
                                    <td>0123456789</td>
                                    <td>Ahmed@yahoo.com</td>
                                    <td>Egypt</td>
                                    <td>Alexandria</td>
                                    <td><small>17/02/2016</small></td>
                                    <td><button type=\"button\" class=\"btn btn-info btn-sm\" data-toggle=\"modal\" data-target=\"#modal-orders\"> 
                                            <i class=\"fa fa-eye\"></i>
                                            View
                                        </button></td>
                                </tr>
                                <tr class=\"accepted\">
                                    <td class=\"ID\">
                                        <input name=\"check\" class=\"chk-box\" id=\"\" value=\"\" type=\"checkbox\">
                                    </td>
                                    <td>Economic Plane</i></td>
                                    <td>Ahmed</i></td>
                                    <td>Mohamed</td>
                                    <td>0123456789</td>
                                    <td>Ahmed@yahoo.com</td>
                                    <td>Egypt</td>
                                    <td>Alexandria</td>
                                    <td><small>17/02/2016</small></td>
                                    <td><button type=\"button\" class=\"btn btn-info btn-sm\" data-toggle=\"modal\" data-target=\"#modal-orders\"> 
                                            <i class=\"fa fa-eye\"></i>
                                            View
                                        </button></td>
                                </tr>
                                <tr class=\"un-seen\">
                                    <td class=\"ID\">
                                        <input name=\"check\" class=\"chk-box\" id=\"\" value=\"\" type=\"checkbox\">
                                    </td>
                                    <td>Enterprise Plane</i></td>
                                    <td>Ahmed</i></td>
                                    <td>Mohamed</td>
                                    <td>0123456789</td>
                                    <td>Ahmed@yahoo.com</td>
                                    <td>Egypt</td>
                                    <td>Alexandria</td>
                                    <td><small>17/02/2016</small></td>
                                    <td><button type=\"button\" class=\"btn btn-info btn-sm\" data-toggle=\"modal\" data-target=\"#modal-orders\"> 
                                            <i class=\"fa fa-eye\"></i>
                                            View
                                        </button></td>
                                </tr>
                                <tr class=\"un-seen\">
                                    <td class=\"ID\">
                                        <input name=\"check\" class=\"chk-box\" id=\"\" value=\"\" type=\"checkbox\">
                                    </td>
                                    <td>Basic Plane</i></td>
                                    <td>Ahmed</i></td>
                                    <td>Mohamed</td>
                                    <td>0123456789</td>
                                    <td>Ahmed@yahoo.com</td>
                                    <td>Egypt</td>
                                    <td>Alexandria</td>
                                    <td><small>17/02/2016</small></td>
                                    <td><button type=\"button\" class=\"btn btn-info btn-sm\" data-toggle=\"modal\" data-target=\"#modal-orders\"> 
                                            <i class=\"fa fa-eye\"></i>
                                            View
                                        </button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"panel-footer\">Panel footer</div>
    </div>
</section>
";
    }

    // line 322
    public function block_modals($context, array $blocks = array())
    {
        // line 323
        echo "<!--EDIT Order  Modal -->
<div class=\"modal fade \" id=\"modal-orders\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"mm\">
    <div class=\"modal-dialog modal-lg\" role=\"document\">
        <div class=\"modal-content modal-contentEn\">
            <div class=\"modal-header\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                <h4 class=\"modal-title\" id=\"gridSystemModalLabel\">Order Plane</h4>
            </div>
            <div class=\"modal-body\">
                <div class=\"row\">
                    <div class=\"col-sm-12\">
                        <div class=\"tap modal-body-header\">
                            <ul class=\"nav nav-pills\" role=\"tablist\">
                                <li role=\"presentation\" class=\"active\"><a href=\"#sectionBasicData\" aria-controls=\"sectionBasicData\" role=\"tab\" data-toggle=\"tab\"><span class=\"badge\">1</span> Basic Data</a>
                                </li>
                                <li role=\"presentation\"><a href=\"#sectionContacts\" aria-controls=\"sectionContacts\" role=\"tab\" data-toggle=\"tab\"><span class=\"badge\">4</span>Contacts</a></li>
                                <li role=\"presentation\"><a href=\"#sectionOthers\" aria-controls=\"sectionOthers\" role=\"tab\" data-toggle=\"tab\"><span class=\"badge\">3</span> Others </a></li>

                            </ul>
                        </div>
                    </div>
                </div>
                <form>
                    <div class=\"tab-content\">
                        <section role=\"tabpanel\" class=\"basic-data tab-pane active\" id=\"sectionBasicData\">
                            <div class=\"row\">
                                <div class=\"form-group col-sm-6\">
                                    <label>First Name</label>
                                    <input id=\"\" type=\"text\" class=\"form-control\" placeholder=\"First Name\" required>
                                </div>
                                <div class=\"form-group col-sm-6\">
                                    <label>Last Name</label>
                                    <input id=\"\" type=\"text\" class=\"form-control\" placeholder=\"Last Name\" required>
                                </div>
                            </div>
                            <div class=\"row\">
                                <div class=\"form-group col-sm-6\">
                                    <label>Social Number</label>
                                    <input id=\"\" type=\"text\" class=\"form-control\" placeholder=\"EX:255 080 116 21458\" required>
                                </div>
                                <div class=\"form-group col-sm-6\">
                                    <label>Choose a Plane</label>
                                    <select id=\"\" name=\"slectSalesman\" class=\"form-control\" required>
                                        <option value=\"0\">Select Your Plane</option>
                                        <option value=\"1\">Basic Plane</option>
                                        <option value=\"2\">Economic Plan</option>
                                        <option value=\"3\">Pro Plan</option>
                                        <option value=\"4\">Enterprise Plan</option>
                                    </select>
                                </div>
                            </div>
                        </section>
                        <section role=\"tabpanel\" class=\"contacts tab-pane\" id=\"sectionContacts\">
                            <div class=\"row\">
                                <div class=\"form-group col-sm-6\">
                                    <label>Telephone</label>
                                    <input id=\"\" type=\"tel\" class=\"form-control\" placeholder=\"0123456789\" required>
                                </div>
                                <div class=\"form-group col-sm-6\">
                                    <label>Mobile</label>
                                    <input id=\"\" type=\"tel\" class=\"form-control\" placeholder=\"0123456789\" required>
                                </div>
                            </div>
                            <div class=\"row\">
                                <div class=\"form-group col-sm-6\">
                                    <label>Address1</label>
                                    <input id=\"\" type=\"text\" class=\"form-control\" placeholder=\"0123456789\" required>
                                </div>
                                <div class=\"form-group col-sm-6\">
                                    <label>Address2</label>
                                    <input id=\"\" type=\"text\" class=\"form-control\" placeholder=\"0123456789\">
                                </div>
                            </div>
                            <div class=\"row\">
                                <div class=\"form-group col-sm-4\">
                                    <label>Choose a Country</label>
                                    <select class=\"crs-country form-control\" data-region-id=\"one\" required></select>


                                </div>
                                <div class=\"form-group col-sm-4\">
                                    <label>State</label>
                                    <select id=\"one\" class=\"form-control\" required></select>
                                </div>
                                <div class=\"form-group col-sm-4\">
                                    <label>city</label>
                                    <input id=\"\" type=\"text\" class=\"form-control\" placeholder=\"Enter city\" required>
                                </div>
                            </div>
                            <div class=\"row\">    
                                <div class=\"form-group col-sm-6\">
                                    <label>Email</label>
                                    <input id=\"\" type=\"email\" class=\"form-control\" placeholder=\"EMAIL\" required>
                                </div>
                                <div class=\"form-group col-sm-6\">
                                    <label>Website</label>
                                    <input id=\"\" type=\"text\" class=\"form-control\" placeholder=\"EX.WWW.zakaa.COM\" >
                                </div>
                            </div>
                        </section>
                        <section role=\"tabpanel\" class=\"sectionOthers tab-pane\" id=\"sectionOthers\">
                            <div class=\"row\">
                                <div class=\"form-group col-sm-6\">
                                    <label>Project Name</label>
                                    <input id=\"\" type=\"text\" class=\"form-control\" placeholder=\"Project Name\" >
                                </div>
                                <div class=\"form-group col-sm-6\">
                                    <label>Uploade Attachment</label>
                                    <input id=\"\" type=\"file\" >
                                </div>
                            </div>
                            <div class=\"row\">
                                <div class=\"form-group col-sm-12\">
                                    <label>Description</label>
                                    <textarea id=\"\" maxlength=\"250\" class=\"form-control col-sm-12\" placeholder=\"Details about your project here\"></textarea>
                                </div>
                            </div>
                        </section>
                    </div>
            </div>
            <div class=\"modal-footer\">
                <button type=\"submit\" id=\"\" class=\"btn btn-main-color\">
                    <span class=\"fa fa-send-o\"> </span> &nbsp;Submit
                </button>
                <button type=\"button\" class=\"btn btn-defult\" data-dismiss=\"modal\">Close</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
";
    }

    public function getTemplateName()
    {
        return "admin/pages/orders.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  356 => 323,  353 => 322,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends 'admin/master.html '%}*/
/* */
/* {% block content%}*/
/* <section class="content">*/
/*     <div class="panel panel-default">*/
/*         <div class="panel-heading">*/
/*             <h3 class="panel-head">Incoming Orders</h3>*/
/*         </div>*/
/*         <div class="panel-body">*/
/*             <div class="container-fluid">*/
/*                 <div class="row top-table">*/
/*                     <div class="col-xs-7">*/
/* */
/*                         <div class="col-xs-5 inner-col">*/
/*                             <div class="btn-group" data-toggle="buttons">*/
/*                                 <label class="btn btn-sm btn-default  active" title="All Plane Type">*/
/*                                     <input type="radio" name="options" id="" autocomplete="off" checked>*/
/*                                     <i class="fa text-active"></i>*/
/*                                     All*/
/*                                 </label>*/
/*                                 <label class="btn btn-sm btn-default" title="Basic Plane">*/
/*                                     <input type="radio" name="options" id="" autocomplete="off" > */
/*                                     <i class="fa text-active"></i>*/
/*                                     Basic*/
/*                                 </label>*/
/*                                 <label class="btn btn-sm btn-default" title="Pro Plane">*/
/*                                     <input type="radio" name="options" id="" autocomplete="off">*/
/*                                     <i class="fa text-active"></i>*/
/*                                     Pro*/
/*                                 </label>*/
/*                                 <label class="btn btn-sm btn-default" title="Economic Plane">*/
/*                                     <input type="radio" name="options" id="" autocomplete="off">*/
/*                                     <i class="fa text-active"></i>*/
/*                                     Eco*/
/*                                 </label>*/
/*                                 <label class="btn btn-sm btn-default" title="Enterprise Plane">*/
/*                                     <input type="radio" name="options" id="" autocomplete="off">*/
/*                                     <i class="fa text-active"></i>*/
/*                                     Custom*/
/*                                 </label>*/
/*                             </div>*/
/*                         </div>*/
/* */
/*                         <div class="col-xs-4 inner-col">*/
/*                             <div class="btn-group" data-toggle="buttons">*/
/*                                 <label class="btn btn-sm btn-default  active" title="All Orders" >*/
/*                                     <input type="radio" name="options" id="" autocomplete="off" checked>*/
/*                                     <i class="fa text-active "></i>*/
/*                                     All*/
/*                                 </label>*/
/*                                 <label class="btn btn-sm btn-default" title="Accepted Orders">*/
/*                                     <input type="radio" name="options" id="" autocomplete="off" > */
/*                                     <i class="fa fa-thumbs-up text-success"></i>*/
/* */
/*                                 </label>*/
/*                                 <label class="btn btn-sm btn-default" title="Rejected Orders">*/
/*                                     <input type="radio" name="options" id="" autocomplete="off" >*/
/*                                     <i class="fa fa-thumbs-down text-danger"></i>*/
/* */
/*                                 </label>*/
/*                                 <label class="btn btn-sm btn-default" title="Todayes Orders">*/
/*                                     <input type="radio" name="options" id="" autocomplete="off" >*/
/*                                     <i class="fa fa-bell "></i>*/
/* */
/*                                 </label>*/
/*                                 <label class="btn btn-sm btn-default" title="Viewed Orders">*/
/*                                     <input type="radio" name="options" id="" autocomplete="off" >*/
/*                                     <i class="fa fa-eye text-primary"></i>*/
/* */
/*                                 </label>*/
/*                                 <label class="btn btn-sm btn-default" title="Unviewed Orders">*/
/*                                     <input type="radio" name="options" id="" autocomplete="off" >*/
/*                                     <i class="fa fa-eye-slash text-danger"></i>*/
/* */
/*                                 </label>*/
/*                             </div>*/
/*                         </div>*/
/* */
/*                         <!--*/
/*                                                     <div class="col-xs-2">*/
/*                                                         <div class="btn-group">*/
/*                                                           <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">*/
/*                                                             <span class="dropdown-label">ACCEPTED</span>*/
/*                                                             <span class="caret"></span>*/
/*                                                           </button>*/
/*                                                           <ul class="dropdown-menu dropdown-select">*/
/*                                                             <li><a href="#"><input type="radio" name="select">ALL STAGES </a></li>*/
/*                                                             <li><a href="#"><input type="radio" name="select">CREATED </a></li>*/
/*                                                             <li><a href="#"><input type="radio" name="select">SENT </a></li>*/
/*                                                             <li><a href="#"><input type="radio" name="select">DRAFT</a></li>*/
/*                                                             <li><a href="#"><input type="radio" name="select">ACCEPTED</a></li>*/
/*                                                             <li><a href="#"><input type="radio" name="select">DECLINED</a></li>*/
/*                                                           </ul>*/
/*                                                         </div>*/
/*                                                     </div>*/
/*                         -->*/
/*                         <!--*/
/*                                                     <div class="col-xs-2">*/
/*                                                         <div class="btn-group" data-toggle="buttons">*/
/*                                                             <label class="btn btn-sm btn-primary">*/
/*                                                                 <input type="checkbox" name="options" id="" autocomplete="off" checked>*/
/*                                                                 <i class="fa fa-filter"></i>*/
/*                                                                     Filter*/
/*                                                             </label>   */
/*                                                         </div>*/
/*                                                     </div>*/
/*                         -->*/
/* */
/*                     </div>*/
/* */
/*                     <div class="ser-a-del col-xs-5">*/
/* */
/* */
/*                         <!--*/
/*                                                     <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete"> */
/*                                                             <i class="fa fa-trash"></i>*/
/*                                                             Delete*/
/*                                                     </button>*/
/*                         -->*/
/*                         <div class="col-xs-8 inner-col">*/
/*                             <div class="input-group">*/
/*                                 <input type="text" class="form-control input-sm" placeholder="Search for...">*/
/*                                 <span class="input-group-btn">*/
/*                                     <button class="btn btn-sm btn-success" type="button">*/
/*                                         <i class="fa fa-search"></i>*/
/*                                     </button>*/
/*                                 </span>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="addNew col-xs-4 ">*/
/*                             <div class="dropdown">*/
/*                                 <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">*/
/*                                     Set As <i class="fa fa-cogs text-danger"></i>*/
/*                                     <span class="caret"></span>*/
/*                                 </button>*/
/*                                 <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">*/
/*                                     <li><a href="#">Accepted &nbsp;<span>    <i class="fa fa-thumbs-up text-success"></i></span></a></li>*/
/*                                     <li><a href="#">Rejected &nbsp;<span>    <i class="fa fa-thumbs-down text-danger"></i></span></a></li>*/
/*                                     <li><a href="#">Seen  &nbsp;<span><i class="fa fa-eye text-primary"></i></span></a></li>*/
/*                                     <li><a href="#">Un Seen  &nbsp;<span><i class="fa fa-eye-slash text-danger"></i></span></a></li>*/
/*                                 </ul>*/
/*                             </div>*/
/* */
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*                 <div class="row">*/
/*                     <div class="table-responsive">*/
/*                         <table class="table table-hover table-orders">*/
/*                             <thead>*/
/*                                 <tr>*/
/*                                     <th id="ID">*/
/*                                         <input id="CheckAll" type="checkbox">*/
/*                                     </th>*/
/*                                     <th>Plane Type</th><th>F-Name</th><th>L-Name</th><th>Mobile</th><th>Email</th><th>Country</th><th>State</th><th>Date</th><th>Operation</th>*/
/*                                 </tr>*/
/*                             </thead>*/
/*                             <tbody>*/
/*                                 <tr class="">*/
/*                                     <td class="ID">*/
/*                                         <input name="check" class="chk-box" id="" value="" type="checkbox">*/
/*                                     </td>*/
/*                                     <td>Basic Plane</i></td>*/
/*                                     <td>Ahmed</i></td>*/
/*                                     <td>Mohamed</td>*/
/*                                     <td>0123456789</td>*/
/*                                     <td>Ahmed@yahoo.com</td>*/
/*                                     <td>Egypt</td>*/
/*                                     <td>Alexandria</td>*/
/*                                     <td><small>17/02/2016</small></td>*/
/*                                     <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-orders"> */
/*                                             <i class="fa fa-eye"></i>*/
/*                                             View*/
/*                                         </button></td>*/
/*                                 </tr>*/
/*                                 <tr class="">*/
/*                                     <td class="ID">*/
/*                                         <input name="check" class="chk-box" id="" value="" type="checkbox">*/
/*                                     </td>*/
/*                                     <td>Basic Plane</i></td>*/
/*                                     <td>Ahmed</i></td>*/
/*                                     <td>Mohamed</td>*/
/*                                     <td>0123456789</td>*/
/*                                     <td>Ahmed@yahoo.com</td>*/
/*                                     <td>Egypt</td>*/
/*                                     <td>Alexandria</td>*/
/*                                     <td><small>17/02/2016</small></td>*/
/*                                     <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-orders"> */
/*                                             <i class="fa fa-eye"></i>*/
/*                                             View*/
/*                                         </button></td>*/
/*                                 </tr>*/
/*                                 <tr class="">*/
/*                                     <td class="ID">*/
/*                                         <input name="check" class="chk-box" id="" value="" type="checkbox">*/
/*                                     </td>*/
/*                                     <td>Basic Plane</i></td>*/
/*                                     <td>Ahmed</i></td>*/
/*                                     <td>Mohamed</td>*/
/*                                     <td>0123456789</td>*/
/*                                     <td>Ahmed@yahoo.com</td>*/
/*                                     <td>Egypt</td>*/
/*                                     <td>Alexandria</td>*/
/*                                     <td><small>17/02/2016</small></td>*/
/*                                     <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-orders"> */
/*                                             <i class="fa fa-eye"></i>*/
/*                                             View*/
/*                                         </button></td>*/
/*                                 </tr>*/
/*                                 <tr class="rejected">*/
/*                                     <td class="ID">*/
/*                                         <input name="check" class="chk-box" id="" value="" type="checkbox">*/
/*                                     </td>*/
/*                                     <td>Pro Plane</i></td>*/
/*                                     <td>Ahmed</i></td>*/
/*                                     <td>Mohamed</td>*/
/*                                     <td>0123456789</td>*/
/*                                     <td>Ahmed@yahoo.com</td>*/
/*                                     <td>Egypt</td>*/
/*                                     <td>Alexandria</td>*/
/*                                     <td><small>17/02/2016</small></td>*/
/*                                     <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-orders"> */
/*                                             <i class="fa fa-eye"></i>*/
/*                                             View*/
/*                                         </button></td>*/
/*                                 </tr>*/
/*                                 <tr class="">*/
/*                                     <td class="ID">*/
/*                                         <input name="check" class="chk-box" id="" value="" type="checkbox">*/
/*                                     </td>*/
/*                                     <td>Basic Plane</i></td>*/
/*                                     <td>Ahmed</i></td>*/
/*                                     <td>Mohamed</td>*/
/*                                     <td>0123456789</td>*/
/*                                     <td>Ahmed@yahoo.com</td>*/
/*                                     <td>Egypt</td>*/
/*                                     <td>Alexandria</td>*/
/*                                     <td><small>17/02/2016</small></td>*/
/*                                     <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-orders"> */
/*                                             <i class="fa fa-eye"></i>*/
/*                                             View*/
/*                                         </button></td>*/
/*                                 </tr>*/
/*                                 <tr class="">*/
/*                                     <td class="ID">*/
/*                                         <input name="check" class="chk-box" id="" value="" type="checkbox">*/
/*                                     </td>*/
/*                                     <td>Basic Plane</i></td>*/
/*                                     <td>Ahmed</i></td>*/
/*                                     <td>Mohamed</td>*/
/*                                     <td>0123456789</td>*/
/*                                     <td>Ahmed@yahoo.com</td>*/
/*                                     <td>Egypt</td>*/
/*                                     <td>Alexandria</td>*/
/*                                     <td><small>17/02/2016</small></td>*/
/*                                     <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-orders"> */
/*                                             <i class="fa fa-eye"></i>*/
/*                                             View*/
/*                                         </button></td>*/
/*                                 </tr>*/
/*                                 <tr class="accepted">*/
/*                                     <td class="ID">*/
/*                                         <input name="check" class="chk-box" id="" value="" type="checkbox">*/
/*                                     </td>*/
/*                                     <td>Economic Plane</i></td>*/
/*                                     <td>Ahmed</i></td>*/
/*                                     <td>Mohamed</td>*/
/*                                     <td>0123456789</td>*/
/*                                     <td>Ahmed@yahoo.com</td>*/
/*                                     <td>Egypt</td>*/
/*                                     <td>Alexandria</td>*/
/*                                     <td><small>17/02/2016</small></td>*/
/*                                     <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-orders"> */
/*                                             <i class="fa fa-eye"></i>*/
/*                                             View*/
/*                                         </button></td>*/
/*                                 </tr>*/
/*                                 <tr class="un-seen">*/
/*                                     <td class="ID">*/
/*                                         <input name="check" class="chk-box" id="" value="" type="checkbox">*/
/*                                     </td>*/
/*                                     <td>Enterprise Plane</i></td>*/
/*                                     <td>Ahmed</i></td>*/
/*                                     <td>Mohamed</td>*/
/*                                     <td>0123456789</td>*/
/*                                     <td>Ahmed@yahoo.com</td>*/
/*                                     <td>Egypt</td>*/
/*                                     <td>Alexandria</td>*/
/*                                     <td><small>17/02/2016</small></td>*/
/*                                     <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-orders"> */
/*                                             <i class="fa fa-eye"></i>*/
/*                                             View*/
/*                                         </button></td>*/
/*                                 </tr>*/
/*                                 <tr class="un-seen">*/
/*                                     <td class="ID">*/
/*                                         <input name="check" class="chk-box" id="" value="" type="checkbox">*/
/*                                     </td>*/
/*                                     <td>Basic Plane</i></td>*/
/*                                     <td>Ahmed</i></td>*/
/*                                     <td>Mohamed</td>*/
/*                                     <td>0123456789</td>*/
/*                                     <td>Ahmed@yahoo.com</td>*/
/*                                     <td>Egypt</td>*/
/*                                     <td>Alexandria</td>*/
/*                                     <td><small>17/02/2016</small></td>*/
/*                                     <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-orders"> */
/*                                             <i class="fa fa-eye"></i>*/
/*                                             View*/
/*                                         </button></td>*/
/*                                 </tr>*/
/*                             </tbody>*/
/*                         </table>*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/*         </div>*/
/*         <div class="panel-footer">Panel footer</div>*/
/*     </div>*/
/* </section>*/
/* {% endblock %}*/
/* {% block modals %}*/
/* <!--EDIT Order  Modal -->*/
/* <div class="modal fade " id="modal-orders" tabindex="-1" role="dialog" aria-labelledby="mm">*/
/*     <div class="modal-dialog modal-lg" role="document">*/
/*         <div class="modal-content modal-contentEn">*/
/*             <div class="modal-header">*/
/*                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>*/
/*                 <h4 class="modal-title" id="gridSystemModalLabel">Order Plane</h4>*/
/*             </div>*/
/*             <div class="modal-body">*/
/*                 <div class="row">*/
/*                     <div class="col-sm-12">*/
/*                         <div class="tap modal-body-header">*/
/*                             <ul class="nav nav-pills" role="tablist">*/
/*                                 <li role="presentation" class="active"><a href="#sectionBasicData" aria-controls="sectionBasicData" role="tab" data-toggle="tab"><span class="badge">1</span> Basic Data</a>*/
/*                                 </li>*/
/*                                 <li role="presentation"><a href="#sectionContacts" aria-controls="sectionContacts" role="tab" data-toggle="tab"><span class="badge">4</span>Contacts</a></li>*/
/*                                 <li role="presentation"><a href="#sectionOthers" aria-controls="sectionOthers" role="tab" data-toggle="tab"><span class="badge">3</span> Others </a></li>*/
/* */
/*                             </ul>*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*                 <form>*/
/*                     <div class="tab-content">*/
/*                         <section role="tabpanel" class="basic-data tab-pane active" id="sectionBasicData">*/
/*                             <div class="row">*/
/*                                 <div class="form-group col-sm-6">*/
/*                                     <label>First Name</label>*/
/*                                     <input id="" type="text" class="form-control" placeholder="First Name" required>*/
/*                                 </div>*/
/*                                 <div class="form-group col-sm-6">*/
/*                                     <label>Last Name</label>*/
/*                                     <input id="" type="text" class="form-control" placeholder="Last Name" required>*/
/*                                 </div>*/
/*                             </div>*/
/*                             <div class="row">*/
/*                                 <div class="form-group col-sm-6">*/
/*                                     <label>Social Number</label>*/
/*                                     <input id="" type="text" class="form-control" placeholder="EX:255 080 116 21458" required>*/
/*                                 </div>*/
/*                                 <div class="form-group col-sm-6">*/
/*                                     <label>Choose a Plane</label>*/
/*                                     <select id="" name="slectSalesman" class="form-control" required>*/
/*                                         <option value="0">Select Your Plane</option>*/
/*                                         <option value="1">Basic Plane</option>*/
/*                                         <option value="2">Economic Plan</option>*/
/*                                         <option value="3">Pro Plan</option>*/
/*                                         <option value="4">Enterprise Plan</option>*/
/*                                     </select>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </section>*/
/*                         <section role="tabpanel" class="contacts tab-pane" id="sectionContacts">*/
/*                             <div class="row">*/
/*                                 <div class="form-group col-sm-6">*/
/*                                     <label>Telephone</label>*/
/*                                     <input id="" type="tel" class="form-control" placeholder="0123456789" required>*/
/*                                 </div>*/
/*                                 <div class="form-group col-sm-6">*/
/*                                     <label>Mobile</label>*/
/*                                     <input id="" type="tel" class="form-control" placeholder="0123456789" required>*/
/*                                 </div>*/
/*                             </div>*/
/*                             <div class="row">*/
/*                                 <div class="form-group col-sm-6">*/
/*                                     <label>Address1</label>*/
/*                                     <input id="" type="text" class="form-control" placeholder="0123456789" required>*/
/*                                 </div>*/
/*                                 <div class="form-group col-sm-6">*/
/*                                     <label>Address2</label>*/
/*                                     <input id="" type="text" class="form-control" placeholder="0123456789">*/
/*                                 </div>*/
/*                             </div>*/
/*                             <div class="row">*/
/*                                 <div class="form-group col-sm-4">*/
/*                                     <label>Choose a Country</label>*/
/*                                     <select class="crs-country form-control" data-region-id="one" required></select>*/
/* */
/* */
/*                                 </div>*/
/*                                 <div class="form-group col-sm-4">*/
/*                                     <label>State</label>*/
/*                                     <select id="one" class="form-control" required></select>*/
/*                                 </div>*/
/*                                 <div class="form-group col-sm-4">*/
/*                                     <label>city</label>*/
/*                                     <input id="" type="text" class="form-control" placeholder="Enter city" required>*/
/*                                 </div>*/
/*                             </div>*/
/*                             <div class="row">    */
/*                                 <div class="form-group col-sm-6">*/
/*                                     <label>Email</label>*/
/*                                     <input id="" type="email" class="form-control" placeholder="EMAIL" required>*/
/*                                 </div>*/
/*                                 <div class="form-group col-sm-6">*/
/*                                     <label>Website</label>*/
/*                                     <input id="" type="text" class="form-control" placeholder="EX.WWW.zakaa.COM" >*/
/*                                 </div>*/
/*                             </div>*/
/*                         </section>*/
/*                         <section role="tabpanel" class="sectionOthers tab-pane" id="sectionOthers">*/
/*                             <div class="row">*/
/*                                 <div class="form-group col-sm-6">*/
/*                                     <label>Project Name</label>*/
/*                                     <input id="" type="text" class="form-control" placeholder="Project Name" >*/
/*                                 </div>*/
/*                                 <div class="form-group col-sm-6">*/
/*                                     <label>Uploade Attachment</label>*/
/*                                     <input id="" type="file" >*/
/*                                 </div>*/
/*                             </div>*/
/*                             <div class="row">*/
/*                                 <div class="form-group col-sm-12">*/
/*                                     <label>Description</label>*/
/*                                     <textarea id="" maxlength="250" class="form-control col-sm-12" placeholder="Details about your project here"></textarea>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </section>*/
/*                     </div>*/
/*             </div>*/
/*             <div class="modal-footer">*/
/*                 <button type="submit" id="" class="btn btn-main-color">*/
/*                     <span class="fa fa-send-o"> </span> &nbsp;Submit*/
/*                 </button>*/
/*                 <button type="button" class="btn btn-defult" data-dismiss="modal">Close</button>*/
/*             </div>*/
/*             </form>*/
/*         </div><!-- /.modal-content -->*/
/*     </div><!-- /.modal-dialog -->*/
/* </div><!-- /.modal -->*/
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
/* */
