<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* product.html.twig */
class __TwigTemplate_1310000c9e27d00452e65215fbb8b534b4b930a409472161463955f85156cec1 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <link rel=\"stylesheet\" href=\"style.css\">
    <title>PHP Pro | Product</title>
</head>
<body>
    <header>

    </header>
    <main>
        <a href=\"index.php\">
        <img src=\"../public/images/item_";
        // line 15
        echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
        echo ".jpg\" alt=\"full size picture\">
        </a>
    </main>
    <footer>

    </footer>
</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "product.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 15,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <link rel=\"stylesheet\" href=\"style.css\">
    <title>PHP Pro | Product</title>
</head>
<body>
    <header>

    </header>
    <main>
        <a href=\"index.php\">
        <img src=\"../public/images/item_{{ id }}.jpg\" alt=\"full size picture\">
        </a>
    </main>
    <footer>

    </footer>
</body>
</html>
", "product.html.twig", "E:\\GitHub\\PHP\\PHP 2\\localhost\\templates\\product.html.twig");
    }
}
