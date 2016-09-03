<?php

/* admin/pages/messages.html */
class __TwigTemplate_ca563d75e28ef24973eec77735f94551ee1a5d4ee34e7505b906d873e24c7d57 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("admin/master.html ", "admin/pages/messages.html", 1);
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
            <h3 class=\"panel-head\">Messages</h3>
        </div>
        <div class=\"panel-body\">
            <div class=\"container-fluid\">
                <div class=\"row top-table\">
                    <div class=\" col-md-8 col-xs-8\">
                        <div class=\" col-md-2 col-xs-2\">
                            <button type=\"button\" class=\"btn btn-sm btn-warning\" data-toggle=\"modal\" data-target=\"#modal-New-message\"> 
                                <i class=\"fa fa-plus\"></i>
                                New
                            </button>
                        </div>
                        <div class=\"col-md-6 col-xs-6\">
                            <div class=\"btn-group\" data-toggle=\"buttons\">

                                <label class=\"btn btn-sm btn-default\" title=\"Inbox Messages\">
                                    <input type=\"radio\" name=\"options\" class=\"msg-filter\" data-filter=\"all\" autocomplete=\"off\" > 
                                    All
                                </label>
                                <label class=\"btn btn-sm btn-default\" title=\"Read Messages\">
                                    <input type=\"radio\" name=\"options\"  class=\"msg-filter\" data-filter=\"seen\" autocomplete=\"off\">
                                    <i class=\"fa fa-eye text-success\"></i>
                                    Read
                                </label>
                                <label class=\"btn btn-sm btn-default\" title=\"Unread Messages\">
                                    <input type=\"radio\" name=\"options\" class=\"msg-filter\" data-filter=\"unseen\" autocomplete=\"off\">
                                    <i class=\"fa fa-eye-slash text-danger\"></i>
                                    Unread
                                </label>
                                <label class=\"btn btn-sm btn-default\" title=\"Today messages\">
                                    <input type=\"radio\" name=\"options\" class=\"msg-filter\" data-filter=\"today\" autocomplete=\"off\">
                                    <i class=\"fa fa-bell text-info \"></i>
                                    Today
                                </label>
                                <label class=\"btn btn-sm btn-default\" title=\"Foreign Messages\">
                                    <input type=\"radio\" name=\"options\" class=\"msg-filter\" data-filter=\"foreign\" autocomplete=\"off\">
                                    <i class=\"fa fa-send text-success\"></i>
                                    Foreign
                                </label>
                            </div>
                        </div>
                        <div class=\"col-md-4 col-xs-4\">
                            <div class=\"dropdown\">
                                <button class=\"btn btn-default dropdown-toggle\" type=\"button\" id=\"dropdownMenu1\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"true\">
                                    Set As <i class=\"fa fa-cogs text-danger\"></i>
                                    <span class=\"caret\"></span>
                                </button>
                                <ul class=\"dropdown-menu\" aria-labelledby=\"dropdownMenu1\">
                                    <li><a href=\"#\" class=\"btn-action\" data-url=\"messages\" data-action=\"seen\"><span><i class=\"fa fa-eye text-primary\"></i></span> &nbsp;Seen  </a></li>
                                    <li><a href=\"#\" class=\"btn-action\" data-url=\"messages\" data-action=\"unseen\"><span><i class=\"fa fa-eye-slash text-danger\"></i></span> &nbsp;Un Seen  </a></li>
                                    <li><a href=\"#\" class=\"btn-action\" data-url=\"messages\" data-action=\"deleted\"><span><i class=\"fa fa-trash text-info\"></i></span> &nbsp;Deleted </a></li>
                                </ul>
                            </div>

                        </div>                        
                    </div> 
                    <div class=\" ser-a-del col-md-4 col-xs-4\">

                        <div class=\"col-xs-8 inner-col\">
                            <form id=\"form-search\" onsubmit=\"return false;\">
                                <div class=\"input-group\">
                                    <input type=\"text\" class=\"form-control input-sm\" name=\"q\" placeholder=\"Search for...\">
                                    <span class=\"input-group-btn\">
                                        <button class=\"btn btn-sm btn-success btn-search\" data-search=\"messages\" type=\"button\">
                                            <i class=\"fa fa-search\"></i>
                                        </button>
                                    </span>
                                </div>
                                ";
        // line 75
        echo call_user_func_array($this->env->getFunction('token_input')->getCallable(), array());
        echo "
                            </form>
                        </div>
                        <div class=\"addNew col-md-4 bcol-xs-4\">
                            <button type=\"button\" class=\"btn btn-danger btn-sm btn-action\" data-url=\"messages\" data-action=\"deleted\"> 
                                <i class=\"fa fa-trash\"></i>
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"table-responsive\">
                        <form id=\"messages-form\" action=\"#\"> 
                            <table class=\"table table-hover table-orders\">
                                <thead>
                                    <tr>
                                        <th id=\"ID\">
                                            <input id=\"CheckAll\" type=\"checkbox\">
                                        </th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Date</th>
                                        <th>Subject</th>
                                        <th>Body</th>
                                        <th>Operations</th>
                                    </tr>
                                </thead>
                                <tbody id=\"msg-table-body\">
                                    ";
        // line 104
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["msgs"]) ? $context["msgs"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["msg"]) {
            // line 105
            echo "                                    ";
            if ($this->getAttribute($context["msg"], "seen", array())) {
                // line 106
                echo "                                    <tr class=\"seen\">
                                        ";
            } else {
                // line 108
                echo "                                    <tr class=\"un-seen\">
                                        ";
            }
            // line 110
            echo "                                        <td class=\"ID\">
                                            <input name=\"ids[]\" class=\"chk-box\" value=\"";
            // line 111
            echo twig_escape_filter($this->env, $this->getAttribute($context["msg"], "id", array()), "html", null, true);
            echo "\" type=\"checkbox\">
                                        </td>
                                        <td>";
            // line 113
            echo twig_escape_filter($this->env, $this->getAttribute($context["msg"], "name", array()), "html", null, true);
            echo "</td>
                                        <td>";
            // line 114
            echo twig_escape_filter($this->env, $this->getAttribute($context["msg"], "from", array()), "html", null, true);
            echo "</td>
                                        <td><small>";
            // line 115
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('readable_time')->getCallable(), array($this->getAttribute($context["msg"], "created_at", array()))), "html", null, true);
            echo "</small></td>
                                        <td>";
            // line 116
            echo twig_escape_filter($this->env, $this->getAttribute($context["msg"], "subject", array()), "html", null, true);
            echo "</td>
                                        <td><p>";
            // line 117
            echo twig_escape_filter($this->env, $this->getAttribute($context["msg"], "body", array()), "html", null, true);
            echo "</p></td>
                                        <td>
                                            <button type=\"button\" class=\"btn btn-info btn-sm btn-msg-view\" data-toggle=\"modal\" data-msg-id=\"";
            // line 119
            echo twig_escape_filter($this->env, $this->getAttribute($context["msg"], "id", array()), "html", null, true);
            echo "\" data-target=\"#modal-message\"> 
                                                <i class=\"fa fa-eye\"></i>
                                                View
                                            </button>
                                        </td>
                                    </tr>
                                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['msg'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 126
        echo "                                </tbody>
                            </table>
                            ";
        // line 128
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

    // line 138
    public function block_modals($context, array $blocks = array())
    {
        // line 139
        echo "<!--New Message Modal -->
<div class=\"modal fade \" id=\"modal-New-message\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"mm\">
    <div class=\"modal-dialog\" role=\"document\">
        <form>
            <div class=\"modal-content\">
                <div class=\"modal-header\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                    <h4 class=\"modal-title\" id=\"gridSystemModalLabel\">New Message</h4>
                </div>
                <div class=\"modal-body\">
                    <div class=\"row\">
                        <div class=\"form-group col-sm-12\">
                            <div class=\"row\">
                                <div class=\"form-group col-sm-6\">
                                    <label>From</label>
                                    <input  type=\"email\" class=\"form-control\" placeholder=\"Enter Email Address\" required>
                                </div>
                                <div class=\"form-group col-sm-6\">
                                    <label>To </label>
                                    <input  type=\"email\" class=\"form-control\" placeholder=\"Enter Email Address\" required>
                                </div>
                            </div>
                            <div class=\"row\">
                                <div class=\"form-group col-sm-6\">
                                    <label>subject</label>
                                    <input  type=\"text\" class=\"form-control\" placeholder=\"Subject ere\" >
                                </div>
                                <div class=\"form-group col-sm-6\">
                                    <label>Uploade Attachment</label>
                                    <input  type=\"file\" >
                                </div>
                            </div>
                            <div class=\"row\">
                                <div class=\"form-group col-sm-12\">
                                    <label>Message</label>
                                    <textarea  maxlength=\"350\" class=\"form-control col-sm-12\" placeholder=\"Text Message Here\"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=\"modal-footer\">
                    <button type=\"button\" class=\"btn btn-defult\" data-dismiss=\"modal\">Cancel</button>
                    <button type=\"submit\" class=\"btn btn-success\">
                        <span class=\"fa fa-send\"> </span> &nbsp;Send
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--View Message Modal -->
<div class=\"modal fade \" id=\"modal-message\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"mm\">
    <div class=\"modal-dialog\" role=\"document\">
            <div class=\"modal-content\">
                <div class=\"modal-header\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                    <h4 class=\"modal-title\" id=\"gridSystemModalLabel\">View Message</h4>
                </div>
                <div class=\"modal-body\" id=\"msg-modal-body\">
                    
                </div>
                <div class=\"modal-footer\">
                    <button type=\"button\" class=\"btn btn-defult\" data-dismiss=\"modal\">Cancel</button>
                    <button type=\"button\" class=\"btn btn-success\" data-dismiss=\"modal\" data-toggle=\"modal\" data-target=\"#modal-New-message\">
                        <span class=\"fa fa-send\"> </span> &nbsp;Replay
                    </button>
                </div>
            </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
";
    }

    // line 212
    public function block_scripts($context, array $blocks = array())
    {
        // line 213
        echo "<script id=\"msg-modal-template\" >";
        $this->loadTemplate("admin/templates/msg-modal-template.html", "admin/pages/messages.html", 213)->display($context);
        echo "</script>
<script id=\"msg-row-template\" >";
        // line 214
        $this->loadTemplate("admin/templates/msg-row-template.html", "admin/pages/messages.html", 214)->display($context);
        echo "</script>
<script src=\"";
        // line 215
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('url_pub')->getCallable(), array("admin/js/process.js")), "html", null, true);
        echo "\"></script>
";
    }

    public function getTemplateName()
    {
        return "admin/pages/messages.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  304 => 215,  300 => 214,  295 => 213,  292 => 212,  216 => 139,  213 => 138,  199 => 128,  195 => 126,  182 => 119,  177 => 117,  173 => 116,  169 => 115,  165 => 114,  161 => 113,  156 => 111,  153 => 110,  149 => 108,  145 => 106,  142 => 105,  138 => 104,  106 => 75,  33 => 4,  30 => 3,  11 => 1,);
    }
}
/* {% extends 'admin/master.html '%}*/
/* */
/* {% block content%}*/
/* <section class="content">*/
/*     <div class="panel panel-default">*/
/*         <div class="panel-heading">*/
/*             <h3 class="panel-head">Messages</h3>*/
/*         </div>*/
/*         <div class="panel-body">*/
/*             <div class="container-fluid">*/
/*                 <div class="row top-table">*/
/*                     <div class=" col-md-8 col-xs-8">*/
/*                         <div class=" col-md-2 col-xs-2">*/
/*                             <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-New-message"> */
/*                                 <i class="fa fa-plus"></i>*/
/*                                 New*/
/*                             </button>*/
/*                         </div>*/
/*                         <div class="col-md-6 col-xs-6">*/
/*                             <div class="btn-group" data-toggle="buttons">*/
/* */
/*                                 <label class="btn btn-sm btn-default" title="Inbox Messages">*/
/*                                     <input type="radio" name="options" class="msg-filter" data-filter="all" autocomplete="off" > */
/*                                     All*/
/*                                 </label>*/
/*                                 <label class="btn btn-sm btn-default" title="Read Messages">*/
/*                                     <input type="radio" name="options"  class="msg-filter" data-filter="seen" autocomplete="off">*/
/*                                     <i class="fa fa-eye text-success"></i>*/
/*                                     Read*/
/*                                 </label>*/
/*                                 <label class="btn btn-sm btn-default" title="Unread Messages">*/
/*                                     <input type="radio" name="options" class="msg-filter" data-filter="unseen" autocomplete="off">*/
/*                                     <i class="fa fa-eye-slash text-danger"></i>*/
/*                                     Unread*/
/*                                 </label>*/
/*                                 <label class="btn btn-sm btn-default" title="Today messages">*/
/*                                     <input type="radio" name="options" class="msg-filter" data-filter="today" autocomplete="off">*/
/*                                     <i class="fa fa-bell text-info "></i>*/
/*                                     Today*/
/*                                 </label>*/
/*                                 <label class="btn btn-sm btn-default" title="Foreign Messages">*/
/*                                     <input type="radio" name="options" class="msg-filter" data-filter="foreign" autocomplete="off">*/
/*                                     <i class="fa fa-send text-success"></i>*/
/*                                     Foreign*/
/*                                 </label>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="col-md-4 col-xs-4">*/
/*                             <div class="dropdown">*/
/*                                 <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">*/
/*                                     Set As <i class="fa fa-cogs text-danger"></i>*/
/*                                     <span class="caret"></span>*/
/*                                 </button>*/
/*                                 <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">*/
/*                                     <li><a href="#" class="btn-action" data-url="messages" data-action="seen"><span><i class="fa fa-eye text-primary"></i></span> &nbsp;Seen  </a></li>*/
/*                                     <li><a href="#" class="btn-action" data-url="messages" data-action="unseen"><span><i class="fa fa-eye-slash text-danger"></i></span> &nbsp;Un Seen  </a></li>*/
/*                                     <li><a href="#" class="btn-action" data-url="messages" data-action="deleted"><span><i class="fa fa-trash text-info"></i></span> &nbsp;Deleted </a></li>*/
/*                                 </ul>*/
/*                             </div>*/
/* */
/*                         </div>                        */
/*                     </div> */
/*                     <div class=" ser-a-del col-md-4 col-xs-4">*/
/* */
/*                         <div class="col-xs-8 inner-col">*/
/*                             <form id="form-search" onsubmit="return false;">*/
/*                                 <div class="input-group">*/
/*                                     <input type="text" class="form-control input-sm" name="q" placeholder="Search for...">*/
/*                                     <span class="input-group-btn">*/
/*                                         <button class="btn btn-sm btn-success btn-search" data-search="messages" type="button">*/
/*                                             <i class="fa fa-search"></i>*/
/*                                         </button>*/
/*                                     </span>*/
/*                                 </div>*/
/*                                 {{ token_input() |raw}}*/
/*                             </form>*/
/*                         </div>*/
/*                         <div class="addNew col-md-4 bcol-xs-4">*/
/*                             <button type="button" class="btn btn-danger btn-sm btn-action" data-url="messages" data-action="deleted"> */
/*                                 <i class="fa fa-trash"></i>*/
/*                                 Delete*/
/*                             </button>*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*                 <div class="row">*/
/*                     <div class="table-responsive">*/
/*                         <form id="messages-form" action="#"> */
/*                             <table class="table table-hover table-orders">*/
/*                                 <thead>*/
/*                                     <tr>*/
/*                                         <th id="ID">*/
/*                                             <input id="CheckAll" type="checkbox">*/
/*                                         </th>*/
/*                                         <th>Name</th>*/
/*                                         <th>Email</th>*/
/*                                         <th>Date</th>*/
/*                                         <th>Subject</th>*/
/*                                         <th>Body</th>*/
/*                                         <th>Operations</th>*/
/*                                     </tr>*/
/*                                 </thead>*/
/*                                 <tbody id="msg-table-body">*/
/*                                     {% for msg in msgs %}*/
/*                                     {% if msg.seen %}*/
/*                                     <tr class="seen">*/
/*                                         {% else %}*/
/*                                     <tr class="un-seen">*/
/*                                         {% endif %}*/
/*                                         <td class="ID">*/
/*                                             <input name="ids[]" class="chk-box" value="{{ msg.id }}" type="checkbox">*/
/*                                         </td>*/
/*                                         <td>{{ msg.name }}</td>*/
/*                                         <td>{{ msg.from }}</td>*/
/*                                         <td><small>{{ readable_time(msg.created_at) }}</small></td>*/
/*                                         <td>{{ msg.subject }}</td>*/
/*                                         <td><p>{{ msg.body }}</p></td>*/
/*                                         <td>*/
/*                                             <button type="button" class="btn btn-info btn-sm btn-msg-view" data-toggle="modal" data-msg-id="{{ msg.id }}" data-target="#modal-message"> */
/*                                                 <i class="fa fa-eye"></i>*/
/*                                                 View*/
/*                                             </button>*/
/*                                         </td>*/
/*                                     </tr>*/
/*                                     {% endfor %}*/
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
/* <!--New Message Modal -->*/
/* <div class="modal fade " id="modal-New-message" tabindex="-1" role="dialog" aria-labelledby="mm">*/
/*     <div class="modal-dialog" role="document">*/
/*         <form>*/
/*             <div class="modal-content">*/
/*                 <div class="modal-header">*/
/*                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>*/
/*                     <h4 class="modal-title" id="gridSystemModalLabel">New Message</h4>*/
/*                 </div>*/
/*                 <div class="modal-body">*/
/*                     <div class="row">*/
/*                         <div class="form-group col-sm-12">*/
/*                             <div class="row">*/
/*                                 <div class="form-group col-sm-6">*/
/*                                     <label>From</label>*/
/*                                     <input  type="email" class="form-control" placeholder="Enter Email Address" required>*/
/*                                 </div>*/
/*                                 <div class="form-group col-sm-6">*/
/*                                     <label>To </label>*/
/*                                     <input  type="email" class="form-control" placeholder="Enter Email Address" required>*/
/*                                 </div>*/
/*                             </div>*/
/*                             <div class="row">*/
/*                                 <div class="form-group col-sm-6">*/
/*                                     <label>subject</label>*/
/*                                     <input  type="text" class="form-control" placeholder="Subject ere" >*/
/*                                 </div>*/
/*                                 <div class="form-group col-sm-6">*/
/*                                     <label>Uploade Attachment</label>*/
/*                                     <input  type="file" >*/
/*                                 </div>*/
/*                             </div>*/
/*                             <div class="row">*/
/*                                 <div class="form-group col-sm-12">*/
/*                                     <label>Message</label>*/
/*                                     <textarea  maxlength="350" class="form-control col-sm-12" placeholder="Text Message Here"></textarea>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*                 <div class="modal-footer">*/
/*                     <button type="button" class="btn btn-defult" data-dismiss="modal">Cancel</button>*/
/*                     <button type="submit" class="btn btn-success">*/
/*                         <span class="fa fa-send"> </span> &nbsp;Send*/
/*                     </button>*/
/*                 </div>*/
/*             </div><!-- /.modal-content -->*/
/*         </form>*/
/*     </div><!-- /.modal-dialog -->*/
/* </div><!-- /.modal -->*/
/* */
/* <!--View Message Modal -->*/
/* <div class="modal fade " id="modal-message" tabindex="-1" role="dialog" aria-labelledby="mm">*/
/*     <div class="modal-dialog" role="document">*/
/*             <div class="modal-content">*/
/*                 <div class="modal-header">*/
/*                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>*/
/*                     <h4 class="modal-title" id="gridSystemModalLabel">View Message</h4>*/
/*                 </div>*/
/*                 <div class="modal-body" id="msg-modal-body">*/
/*                     */
/*                 </div>*/
/*                 <div class="modal-footer">*/
/*                     <button type="button" class="btn btn-defult" data-dismiss="modal">Cancel</button>*/
/*                     <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#modal-New-message">*/
/*                         <span class="fa fa-send"> </span> &nbsp;Replay*/
/*                     </button>*/
/*                 </div>*/
/*             </div><!-- /.modal-content -->*/
/*     </div><!-- /.modal-dialog -->*/
/* </div><!-- /.modal -->*/
/* {% endblock %}*/
/* {% block scripts %}*/
/* <script id="msg-modal-template" >{% include 'admin/templates/msg-modal-template.html' %}</script>*/
/* <script id="msg-row-template" >{% include 'admin/templates/msg-row-template.html' %}</script>*/
/* <script src="{{ url_pub('admin/js/process.js') }}"></script>*/
/* {% endblock %}*/
