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
            'scripts' => array($this, 'block_scripts'),
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
                                <label class=\"btn btn-sm btn-default  active\" title=\"All Plan Types\">
                                    <input type=\"radio\" name=\"options\" class=\"btn-plan-filter\" data-filter=\"all\"  autocomplete=\"off\" checked>
                                    <i class=\"fa text-active\"></i>
                                    All
                                </label>
                                <label class=\"btn btn-sm btn-default\" title=\"Basic Plan\">
                                    <input type=\"radio\" name=\"options\" class=\"btn-plan-filter\" data-filter=\"basic-plan\"  autocomplete=\"off\" > 
                                    <i class=\"fa text-active\"></i>
                                    Basic
                                </label>
                                <label class=\"btn btn-sm btn-default\" title=\"Pro Plan\">
                                    <input type=\"radio\" name=\"options\"  class=\"btn-plan-filter\" data-filter=\"pro-plan\" autocomplete=\"off\">
                                    <i class=\"fa text-active\"></i>
                                    Pro
                                </label>
                                <label class=\"btn btn-sm btn-default\" title=\"Economic Plan\">
                                    <input type=\"radio\" name=\"options\"  class=\"btn-plan-filter\" data-filter=\"economic-plan\" autocomplete=\"off\">
                                    <i class=\"fa text-active\"></i>
                                    Eco
                                </label>
                                <label class=\"btn btn-sm btn-default\" title=\"Enterprise Plan\">
                                    <input type=\"radio\" name=\"options\" class=\"btn-plan-filter\" data-filter=\"enterprise-plan\"  autocomplete=\"off\">
                                    <i class=\"fa text-active\"></i>
                                    Custom
                                </label>
                            </div>
                        </div>

                        <div class=\"col-xs-4 inner-col\">
                            <div class=\"btn-group\" data-toggle=\"buttons\">
                                <label class=\"btn btn-sm btn-default active\" title=\"All Orders\">
                                    <input type=\"radio\" class=\"btn-status-filter\" data-filter=\"all\" name=\"options\"  autocomplete=\"off\" > 
                                    All
                                </label>
                                <label class=\"btn btn-sm btn-default\" title=\"Accepted Orders\">
                                    <input type=\"radio\" class=\"btn-status-filter\" data-filter=\"accepted\" name=\"options\"  autocomplete=\"off\" > 
                                    <i class=\"fa fa-thumbs-up text-success\"></i>
                                </label>
                                <label class=\"btn btn-sm btn-default\" title=\"Rejected Orders\">
                                    <input type=\"radio\" class=\"btn-status-filter\" data-filter=\"rejected\" name=\"options\"  autocomplete=\"off\" >
                                    <i class=\"fa fa-thumbs-down text-danger\"></i>
                                </label>
                                <label class=\"btn btn-sm btn-default\" title=\"Today Orders\">
                                    <input type=\"radio\" class=\"btn-status-filter\" data-filter=\"today\" name=\"options\"  autocomplete=\"off\" >
                                    <i class=\"fa fa-bell \"></i>
                                </label>
                                <label class=\"btn btn-sm btn-default\" title=\"Viewed Orders\">
                                    <input type=\"radio\" class=\"btn-status-filter\" data-filter=\"seen\" name=\"options\"  autocomplete=\"off\" >
                                    <i class=\"fa fa-eye text-primary\"></i>
                                </label>
                                <label class=\"btn btn-sm btn-default\" title=\"Unviewed Orders\">
                                    <input type=\"radio\" class=\"btn-status-filter\" data-filter=\"unseen\" name=\"options\"  autocomplete=\"off\" >
                                    <i class=\"fa fa-eye-slash text-danger\"></i>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class=\"ser-a-del col-xs-5\">
                        <div class=\"col-xs-8 inner-col\">
                            <form id=\"form-search\" onsubmit=\"return false;\">
                                <div class=\"input-group\">
                                    <input type=\"text\" class=\"form-control input-sm\" name=\"q\" placeholder=\"Search for...\">
                                    <span class=\"input-group-btn\">
                                        <button class=\"btn btn-sm btn-success btn-search \" data-search=\"orders\" type=\"button\">
                                            <i class=\"fa fa-search\"></i>
                                        </button>
                                    </span>
                                </div>
                                ";
        // line 85
        echo call_user_func_array($this->env->getFunction('token_input')->getCallable(), array());
        echo "
                            </form>
                        </div>
                        <div class=\"addNew col-xs-4 \">
                            <div class=\"dropdown\">
                                <button class=\"btn btn-default dropdown-toggle\" type=\"button\" id=\"dropdownMenu1\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"true\">
                                    Set As <i class=\"fa fa-cogs text-danger\"></i>
                                    <span class=\"caret\"></span>
                                </button>
                                <ul class=\"dropdown-menu\" aria-labelledby=\"dropdownMenu1\">
                                    <li><a href=\"#\" class=\"btn-action\" data-url=\"orders\" data-action=\"accepted\"><span><i class=\"fa fa-thumbs-up text-success\"></i></span> &nbsp;Accepted </a></li>
                                    <li><a href=\"#\" class=\"btn-action\" data-url=\"orders\" data-action=\"rejected\"><span><i class=\"fa fa-thumbs-down text-danger\"></i></span> &nbsp;Rejected </a></li>
                                    <li><a href=\"#\" class=\"btn-action\" data-url=\"orders\" data-action=\"seen\"><span><i class=\"fa fa-eye text-primary\"></i></span> &nbsp;Seen  </a></li>
                                    <li><a href=\"#\" class=\"btn-action\" data-url=\"orders\" data-action=\"unseen\"><span><i class=\"fa fa-eye-slash text-danger\"></i></span> &nbsp;Un Seen  </a></li>
                                    <li><a href=\"#\" class=\"btn-action\" data-url=\"orders\" data-action=\"deleted\"><span><i class=\"fa fa-trash text-info\"></i></span> &nbsp;Deleted </a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"table-responsive\">
                        <form id=\"orders-form\" action=\"#\">
                            <table class=\"table table-hover table-orders\">
                                <thead>
                                    <tr>
                                        <th id=\"ID\">
                                            <input id=\"CheckAll\" type=\"checkbox\">
                                        </th>
                                        <th>Plan Type</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Country</th>
                                        <th>State</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Operation</th>
                                    </tr>
                                </thead>
                                <tbody id=\"order-table-body\">
                                    ";
        // line 126
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["orders"]) ? $context["orders"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["order"]) {
            // line 127
            echo "                                    ";
            if ($this->getAttribute($context["order"], "seen", array())) {
                // line 128
                echo "                                    <tr class=\"seen\">
                                        ";
            } else {
                // line 130
                echo "                                    <tr class=\"un-seen\">
                                        ";
            }
            // line 132
            echo "                                        <td class=\"ID\">
                                            <input name=\"ids[]\" class=\"chk-box\" value=\"";
            // line 133
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "id", array()), "html", null, true);
            echo "\" type=\"checkbox\">
                                        </td>
                                        <td>";
            // line 135
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "plan", array()), "html", null, true);
            echo "</td>
                                        <td>";
            // line 136
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "firstname", array()), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "lastname", array()), "html", null, true);
            echo "</td>
                                        <td>";
            // line 137
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "email", array()), "html", null, true);
            echo "</td>
                                        <td>";
            // line 138
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "country", array()), "html", null, true);
            echo "</td>
                                        <td>";
            // line 139
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "state", array()), "html", null, true);
            echo "</td>
                                        <td><small>";
            // line 140
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('readable_time')->getCallable(), array($this->getAttribute($context["order"], "created_at", array()))), "html", null, true);
            echo "</small></td>
                                        <td>
                                            ";
            // line 142
            if ($this->getAttribute($context["order"], "rejected", array())) {
                // line 143
                echo "                                            <i class=\"fa fa-thumbs-down text-danger\"></i>
                                            ";
            } else {
                // line 145
                echo "                                            <i class=\"fa fa-thumbs-up text-success\"></i>                                
                                            ";
            }
            // line 147
            echo "                                            ";
            if ($this->getAttribute($context["order"], "seen", array())) {
                // line 148
                echo "                                            <i class=\"fa fa-eye text-primary\"></i>
                                            ";
            } else {
                // line 150
                echo "                                            <i class=\"fa fa-eye-slash text-danger\"></i>
                                            ";
            }
            // line 152
            echo "                                        </td>
                                        <td>
                                            <button type=\"button\" class=\"btn btn-info btn-sm btn-order-view\" data-order-id=\"";
            // line 154
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "id", array()), "html", null, true);
            echo "\" data-toggle=\"modal\" data-target=\"#modal-orders\"> 
                                                <i class=\"fa fa-eye\"></i>
                                                View
                                            </button>
                                        </td>
                                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 160
        echo "                                    </tr>
                                </tbody>
                            </table>
                            ";
        // line 163
        echo call_user_func_array($this->env->getFunction('token_input')->getCallable(), array());
        echo "
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"panel-footer\">Panel footer</div>
    </div>
</section>
";
    }

    // line 173
    public function block_modals($context, array $blocks = array())
    {
        // line 174
        echo "<!--EDIT Order  Modal -->
<div class=\"modal fade \" id=\"modal-orders\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"mm\">
    <div class=\"modal-dialog modal-lg\" role=\"document\">
        <div class=\"modal-content modal-contentEn\">
            <div class=\"modal-header\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                <h4 class=\"modal-title\" id=\"gridSystemModalLabel\">Order Plan</h4>
            </div>
            <div class=\"modal-body\" id=\"order-modal-body\">
                
            </div>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-defult\" data-dismiss=\"modal\">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
";
    }

    // line 192
    public function block_scripts($context, array $blocks = array())
    {
        // line 193
        echo "<script id=\"order-modal-template\" >";
        $this->loadTemplate("admin/templates/order-modal-template.html", "admin/pages/orders.html", 193)->display($context);
        echo "</script>
<script id=\"order-row-template\" >";
        // line 194
        $this->loadTemplate("admin/templates/order-row-template.html", "admin/pages/orders.html", 194)->display($context);
        echo "</script>
<script src=\"";
        // line 195
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_pub')->getCallable(), array("admin/js/process.js")), "html", null, true);
        echo "\"></script>
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
        return array (  302 => 195,  298 => 194,  293 => 193,  290 => 192,  269 => 174,  266 => 173,  252 => 163,  247 => 160,  235 => 154,  231 => 152,  227 => 150,  223 => 148,  220 => 147,  216 => 145,  212 => 143,  210 => 142,  205 => 140,  201 => 139,  197 => 138,  193 => 137,  187 => 136,  183 => 135,  178 => 133,  175 => 132,  171 => 130,  167 => 128,  164 => 127,  160 => 126,  116 => 85,  33 => 4,  30 => 3,  11 => 1,);
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
/*                                 <label class="btn btn-sm btn-default  active" title="All Plan Types">*/
/*                                     <input type="radio" name="options" class="btn-plan-filter" data-filter="all"  autocomplete="off" checked>*/
/*                                     <i class="fa text-active"></i>*/
/*                                     All*/
/*                                 </label>*/
/*                                 <label class="btn btn-sm btn-default" title="Basic Plan">*/
/*                                     <input type="radio" name="options" class="btn-plan-filter" data-filter="basic-plan"  autocomplete="off" > */
/*                                     <i class="fa text-active"></i>*/
/*                                     Basic*/
/*                                 </label>*/
/*                                 <label class="btn btn-sm btn-default" title="Pro Plan">*/
/*                                     <input type="radio" name="options"  class="btn-plan-filter" data-filter="pro-plan" autocomplete="off">*/
/*                                     <i class="fa text-active"></i>*/
/*                                     Pro*/
/*                                 </label>*/
/*                                 <label class="btn btn-sm btn-default" title="Economic Plan">*/
/*                                     <input type="radio" name="options"  class="btn-plan-filter" data-filter="economic-plan" autocomplete="off">*/
/*                                     <i class="fa text-active"></i>*/
/*                                     Eco*/
/*                                 </label>*/
/*                                 <label class="btn btn-sm btn-default" title="Enterprise Plan">*/
/*                                     <input type="radio" name="options" class="btn-plan-filter" data-filter="enterprise-plan"  autocomplete="off">*/
/*                                     <i class="fa text-active"></i>*/
/*                                     Custom*/
/*                                 </label>*/
/*                             </div>*/
/*                         </div>*/
/* */
/*                         <div class="col-xs-4 inner-col">*/
/*                             <div class="btn-group" data-toggle="buttons">*/
/*                                 <label class="btn btn-sm btn-default active" title="All Orders">*/
/*                                     <input type="radio" class="btn-status-filter" data-filter="all" name="options"  autocomplete="off" > */
/*                                     All*/
/*                                 </label>*/
/*                                 <label class="btn btn-sm btn-default" title="Accepted Orders">*/
/*                                     <input type="radio" class="btn-status-filter" data-filter="accepted" name="options"  autocomplete="off" > */
/*                                     <i class="fa fa-thumbs-up text-success"></i>*/
/*                                 </label>*/
/*                                 <label class="btn btn-sm btn-default" title="Rejected Orders">*/
/*                                     <input type="radio" class="btn-status-filter" data-filter="rejected" name="options"  autocomplete="off" >*/
/*                                     <i class="fa fa-thumbs-down text-danger"></i>*/
/*                                 </label>*/
/*                                 <label class="btn btn-sm btn-default" title="Today Orders">*/
/*                                     <input type="radio" class="btn-status-filter" data-filter="today" name="options"  autocomplete="off" >*/
/*                                     <i class="fa fa-bell "></i>*/
/*                                 </label>*/
/*                                 <label class="btn btn-sm btn-default" title="Viewed Orders">*/
/*                                     <input type="radio" class="btn-status-filter" data-filter="seen" name="options"  autocomplete="off" >*/
/*                                     <i class="fa fa-eye text-primary"></i>*/
/*                                 </label>*/
/*                                 <label class="btn btn-sm btn-default" title="Unviewed Orders">*/
/*                                     <input type="radio" class="btn-status-filter" data-filter="unseen" name="options"  autocomplete="off" >*/
/*                                     <i class="fa fa-eye-slash text-danger"></i>*/
/*                                 </label>*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="ser-a-del col-xs-5">*/
/*                         <div class="col-xs-8 inner-col">*/
/*                             <form id="form-search" onsubmit="return false;">*/
/*                                 <div class="input-group">*/
/*                                     <input type="text" class="form-control input-sm" name="q" placeholder="Search for...">*/
/*                                     <span class="input-group-btn">*/
/*                                         <button class="btn btn-sm btn-success btn-search " data-search="orders" type="button">*/
/*                                             <i class="fa fa-search"></i>*/
/*                                         </button>*/
/*                                     </span>*/
/*                                 </div>*/
/*                                 {{ token_input() |raw}}*/
/*                             </form>*/
/*                         </div>*/
/*                         <div class="addNew col-xs-4 ">*/
/*                             <div class="dropdown">*/
/*                                 <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">*/
/*                                     Set As <i class="fa fa-cogs text-danger"></i>*/
/*                                     <span class="caret"></span>*/
/*                                 </button>*/
/*                                 <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">*/
/*                                     <li><a href="#" class="btn-action" data-url="orders" data-action="accepted"><span><i class="fa fa-thumbs-up text-success"></i></span> &nbsp;Accepted </a></li>*/
/*                                     <li><a href="#" class="btn-action" data-url="orders" data-action="rejected"><span><i class="fa fa-thumbs-down text-danger"></i></span> &nbsp;Rejected </a></li>*/
/*                                     <li><a href="#" class="btn-action" data-url="orders" data-action="seen"><span><i class="fa fa-eye text-primary"></i></span> &nbsp;Seen  </a></li>*/
/*                                     <li><a href="#" class="btn-action" data-url="orders" data-action="unseen"><span><i class="fa fa-eye-slash text-danger"></i></span> &nbsp;Un Seen  </a></li>*/
/*                                     <li><a href="#" class="btn-action" data-url="orders" data-action="deleted"><span><i class="fa fa-trash text-info"></i></span> &nbsp;Deleted </a></li>*/
/*                                 </ul>*/
/*                             </div>*/
/* */
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*                 <div class="row">*/
/*                     <div class="table-responsive">*/
/*                         <form id="orders-form" action="#">*/
/*                             <table class="table table-hover table-orders">*/
/*                                 <thead>*/
/*                                     <tr>*/
/*                                         <th id="ID">*/
/*                                             <input id="CheckAll" type="checkbox">*/
/*                                         </th>*/
/*                                         <th>Plan Type</th>*/
/*                                         <th>Full Name</th>*/
/*                                         <th>Email</th>*/
/*                                         <th>Country</th>*/
/*                                         <th>State</th>*/
/*                                         <th>Date</th>*/
/*                                         <th>Status</th>*/
/*                                         <th>Operation</th>*/
/*                                     </tr>*/
/*                                 </thead>*/
/*                                 <tbody id="order-table-body">*/
/*                                     {% for order in orders %}*/
/*                                     {% if order.seen %}*/
/*                                     <tr class="seen">*/
/*                                         {% else %}*/
/*                                     <tr class="un-seen">*/
/*                                         {% endif %}*/
/*                                         <td class="ID">*/
/*                                             <input name="ids[]" class="chk-box" value="{{ order.id }}" type="checkbox">*/
/*                                         </td>*/
/*                                         <td>{{ order.plan }}</td>*/
/*                                         <td>{{ order.firstname }} {{ order.lastname }}</td>*/
/*                                         <td>{{ order.email }}</td>*/
/*                                         <td>{{ order.country }}</td>*/
/*                                         <td>{{ order.state}}</td>*/
/*                                         <td><small>{{ readable_time(order.created_at) }}</small></td>*/
/*                                         <td>*/
/*                                             {% if order.rejected %}*/
/*                                             <i class="fa fa-thumbs-down text-danger"></i>*/
/*                                             {% else %}*/
/*                                             <i class="fa fa-thumbs-up text-success"></i>                                */
/*                                             {% endif %}*/
/*                                             {% if order.seen %}*/
/*                                             <i class="fa fa-eye text-primary"></i>*/
/*                                             {% else %}*/
/*                                             <i class="fa fa-eye-slash text-danger"></i>*/
/*                                             {% endif %}*/
/*                                         </td>*/
/*                                         <td>*/
/*                                             <button type="button" class="btn btn-info btn-sm btn-order-view" data-order-id="{{ order.id }}" data-toggle="modal" data-target="#modal-orders"> */
/*                                                 <i class="fa fa-eye"></i>*/
/*                                                 View*/
/*                                             </button>*/
/*                                         </td>*/
/*                                         {% endfor %}*/
/*                                     </tr>*/
/*                                 </tbody>*/
/*                             </table>*/
/*                             {{ token_input() |raw}}*/
/*                         </form>*/
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
/*                 <h4 class="modal-title" id="gridSystemModalLabel">Order Plan</h4>*/
/*             </div>*/
/*             <div class="modal-body" id="order-modal-body">*/
/*                 */
/*             </div>*/
/*             <div class="modal-footer">*/
/*                 <button type="button" class="btn btn-defult" data-dismiss="modal">Close</button>*/
/*             </div>*/
/*         </div><!-- /.modal-content -->*/
/*     </div><!-- /.modal-dialog -->*/
/* </div><!-- /.modal -->*/
/* {% endblock %}*/
/* {% block scripts %}*/
/* <script id="order-modal-template" >{% include 'admin/templates/order-modal-template.html' %}</script>*/
/* <script id="order-row-template" >{% include 'admin/templates/order-row-template.html' %}</script>*/
/* <script src="{{ url_pub('admin/js/process.js') }}"></script>*/
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
