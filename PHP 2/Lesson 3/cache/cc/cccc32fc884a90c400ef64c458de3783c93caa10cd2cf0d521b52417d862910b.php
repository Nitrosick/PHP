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

/* book.html.twig */
class __TwigTemplate_e036ed35c052b0d01afc898741f831aaca4654cc808658768c892687c7353cb6 extends Template
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
    <title>PHP Pro | Book</title>
</head>
<body>
    <header>
        <a href=\"index.php\">to index.php</a>
    </header>
    <main>
        <table>
        ";
        // line 20
        echo "            <tr> <td>Title</td> <td>";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["array"] ?? null), "title", [], "any", false, false, false, 20), "html", null, true);
        echo "</td> </tr>
            <tr> <td>Author</td> <td>";
        // line 21
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["array"] ?? null), "author", [], "any", false, false, false, 21), "html", null, true);
        echo "</td> </tr>
            <tr> <td>Publisher</td> <td>";
        // line 22
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["array"] ?? null), "publisher", [], "any", false, false, false, 22), "html", null, true);
        echo "</td> </tr>
            <tr> <td>Pages</td> <td>";
        // line 23
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["array"] ?? null), "pages", [], "any", false, false, false, 23), "html", null, true);
        echo "</td> </tr>
            <tr> <td>Cathegory</td> <td>";
        // line 24
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["array"] ?? null), "cathegory", [], "any", false, false, false, 24), "html", null, true);
        echo "</td> </tr>
        </table>
    </main>
    <footer>

    </footer>
</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "book.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  70 => 24,  66 => 23,  62 => 22,  58 => 21,  53 => 20,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <link rel=\"stylesheet\" href=\"style.css\">
    <title>PHP Pro | Book</title>
</head>
<body>
    <header>
        <a href=\"index.php\">to index.php</a>
    </header>
    <main>
        <table>
        {# {% for a in array %}
            <tr>
                <td>{{ a['parameter'] }}</td> <td>{{ a['value'] }}</td>
            </tr>
        {% endfor %} #}
            <tr> <td>Title</td> <td>{{ array.title }}</td> </tr>
            <tr> <td>Author</td> <td>{{ array.author }}</td> </tr>
            <tr> <td>Publisher</td> <td>{{ array.publisher }}</td> </tr>
            <tr> <td>Pages</td> <td>{{ array.pages }}</td> </tr>
            <tr> <td>Cathegory</td> <td>{{ array.cathegory }}</td> </tr>
        </table>
    </main>
    <footer>

    </footer>
</body>
</html>
", "book.html.twig", "E:\\GitHub\\PHP\\PHP 2\\localhost\\templates\\book.html.twig");
    }
}
