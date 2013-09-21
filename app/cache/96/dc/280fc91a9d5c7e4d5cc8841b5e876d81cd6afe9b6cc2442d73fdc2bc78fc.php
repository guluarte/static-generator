<?php

/* index.html */
class __TwigTemplate_96dc280fc91a9d5c7e4d5cc8841b5e876d81cd6afe9b6cc2442d73fdc2bc78fc extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );

        $this->macros = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
<head>
  <title>";
        // line 4
        echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
        echo "</title>
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
  <!-- Bootstrap -->
  <link rel=\"stylesheet\" href=\"//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css\">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src=\"../../assets/js/html5shiv.js\"></script>
      <script src=\"../../assets/js/respond.min.js\"></script>
      <![endif]-->
    </head>
    <body>

      <!-- Static navbar -->
      <div class=\"navbar navbar-default navbar-static-top\">
        <div class=\"container\">
          <div class=\"navbar-header\">
            <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-collapse\">
              <span class=\"icon-bar\"></span>
              <span class=\"icon-bar\"></span>
              <span class=\"icon-bar\"></span>
            </button>
            <a class=\"navbar-brand\" href=\"#\">Static Generator</a>
          </div>
          <div class=\"navbar-collapse collapse\">
            <ul class=\"nav navbar-nav\">
              <li class=\"active\"><a href=\"#\">Home</a></li>
              <li><a href=\"#about\">About</a></li>
              <li><a href=\"#contact\">Contact</a></li>
              <li class=\"dropdown\">
                <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Dropdown <b class=\"caret\"></b></a>
                <ul class=\"dropdown-menu\">
                  <li><a href=\"#\">Action</a></li>
                  <li><a href=\"#\">Another action</a></li>
                  <li><a href=\"#\">Something else here</a></li>
                  <li class=\"divider\"></li>
                  <li class=\"dropdown-header\">Nav header</li>
                  <li><a href=\"#\">Separated link</a></li>
                  <li><a href=\"#\">One more separated link</a></li>
                </ul>
              </li>
            </ul>
            <ul class=\"nav navbar-nav navbar-right\">
              <li><a href=\"../navbar/\">Default</a></li>
              <li class=\"active\"><a href=\"./\">Staregergtic top</a></li>
              <li><a href=\"../navbar-fixed-top/\">Fixed top</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>


      <div class=\"container\">
      dffergergergerg

      </div> <!-- /container -->


      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src=\"//code.jquery.com/jquery.js\"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src=\"//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js\"></script>
    </body>
    </html>";
    }

    public function getTemplateName()
    {
        return "index.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  27 => 4,  22 => 1,);
    }
}
