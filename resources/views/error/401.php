{% extends 'app.html'%}
{% block content %}
<!--Start Page content-->
<section class="error">
    <div class="container text-center">
        <div class="row">
            <div class="content col-sm-12 col-md-push-0 col-xs-10 col-xs-push-1">
                <h1>401 Error Page</h1>
                <p>هناك خطا داخلي الي ان يتم تصحيحه عد في وقت لاحق</p>
                <a class="btn" href="{{ url_route('home') }}"> العودة للرئيسية</a>
            </div>
        </div>
    </div>
</section>
<!--End Page content-->
{% endblock %} 