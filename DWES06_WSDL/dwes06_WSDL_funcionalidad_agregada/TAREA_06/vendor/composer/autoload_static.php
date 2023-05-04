<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit15308d529b25ba8f236f28b6c4365e3c
{
    public static $files = array (
        'def43f6c87e4f8dfd0c9e1b1bab14fe8' => __DIR__ . '/..' . '/symfony/polyfill-iconv/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'Wsdl2PhpGenerator\\' => 18,
            'Wingu\\OctopusCore\\Reflection\\' => 29,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Iconv\\' => 23,
            'Symfony\\Component\\OptionsResolver\\' => 34,
        ),
        'P' => 
        array (
            'PHP2WSDL\\' => 9,
        ),
        'C' => 
        array (
            'Clases\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Wsdl2PhpGenerator\\' => 
        array (
            0 => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/src',
            1 => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/lib',
        ),
        'Wingu\\OctopusCore\\Reflection\\' => 
        array (
            0 => __DIR__ . '/..' . '/wingu/reflection/src',
        ),
        'Symfony\\Polyfill\\Iconv\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-iconv',
        ),
        'Symfony\\Component\\OptionsResolver\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/options-resolver',
        ),
        'PHP2WSDL\\' => 
        array (
            0 => __DIR__ . '/..' . '/php2wsdl/php2wsdl/src',
        ),
        'Clases\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Clases\\Conexion' => __DIR__ . '/../..' . '/src/Conexion.php',
        'Clases\\Familia' => __DIR__ . '/../..' . '/src/Familia.php',
        'Clases\\Operaciones' => __DIR__ . '/../..' . '/src/Operaciones.php',
        'Clases\\Producto' => __DIR__ . '/../..' . '/src/Producto.php',
        'Clases\\Stock' => __DIR__ . '/../..' . '/src/Stock.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'PHP2WSDL\\PHPClass2WSDL' => __DIR__ . '/..' . '/php2wsdl/php2wsdl/src/PHPClass2WSDL.php',
        'PHP2WSDL\\WSDL' => __DIR__ . '/..' . '/php2wsdl/php2wsdl/src/WSDL.php',
        'Symfony\\Component\\OptionsResolver\\Debug\\OptionsResolverIntrospector' => __DIR__ . '/..' . '/symfony/options-resolver/Debug/OptionsResolverIntrospector.php',
        'Symfony\\Component\\OptionsResolver\\Exception\\AccessException' => __DIR__ . '/..' . '/symfony/options-resolver/Exception/AccessException.php',
        'Symfony\\Component\\OptionsResolver\\Exception\\ExceptionInterface' => __DIR__ . '/..' . '/symfony/options-resolver/Exception/ExceptionInterface.php',
        'Symfony\\Component\\OptionsResolver\\Exception\\InvalidArgumentException' => __DIR__ . '/..' . '/symfony/options-resolver/Exception/InvalidArgumentException.php',
        'Symfony\\Component\\OptionsResolver\\Exception\\InvalidOptionsException' => __DIR__ . '/..' . '/symfony/options-resolver/Exception/InvalidOptionsException.php',
        'Symfony\\Component\\OptionsResolver\\Exception\\MissingOptionsException' => __DIR__ . '/..' . '/symfony/options-resolver/Exception/MissingOptionsException.php',
        'Symfony\\Component\\OptionsResolver\\Exception\\NoConfigurationException' => __DIR__ . '/..' . '/symfony/options-resolver/Exception/NoConfigurationException.php',
        'Symfony\\Component\\OptionsResolver\\Exception\\NoSuchOptionException' => __DIR__ . '/..' . '/symfony/options-resolver/Exception/NoSuchOptionException.php',
        'Symfony\\Component\\OptionsResolver\\Exception\\OptionDefinitionException' => __DIR__ . '/..' . '/symfony/options-resolver/Exception/OptionDefinitionException.php',
        'Symfony\\Component\\OptionsResolver\\Exception\\UndefinedOptionsException' => __DIR__ . '/..' . '/symfony/options-resolver/Exception/UndefinedOptionsException.php',
        'Symfony\\Component\\OptionsResolver\\Options' => __DIR__ . '/..' . '/symfony/options-resolver/Options.php',
        'Symfony\\Component\\OptionsResolver\\OptionsResolver' => __DIR__ . '/..' . '/symfony/options-resolver/OptionsResolver.php',
        'Symfony\\Polyfill\\Iconv\\Iconv' => __DIR__ . '/..' . '/symfony/polyfill-iconv/Iconv.php',
        'Wingu\\OctopusCore\\Reflection\\Annotation\\AnnotationDefinition' => __DIR__ . '/..' . '/wingu/reflection/src/Annotation/AnnotationDefinition.php',
        'Wingu\\OctopusCore\\Reflection\\Annotation\\AnnotationsCollection' => __DIR__ . '/..' . '/wingu/reflection/src/Annotation/AnnotationsCollection.php',
        'Wingu\\OctopusCore\\Reflection\\Annotation\\Exceptions\\Exception' => __DIR__ . '/..' . '/wingu/reflection/src/Annotation/Exceptions/Exception.php',
        'Wingu\\OctopusCore\\Reflection\\Annotation\\Exceptions\\InvalidArgumentException' => __DIR__ . '/..' . '/wingu/reflection/src/Annotation/Exceptions/InvalidArgumentException.php',
        'Wingu\\OctopusCore\\Reflection\\Annotation\\Exceptions\\OutOfBoundsException' => __DIR__ . '/..' . '/wingu/reflection/src/Annotation/Exceptions/OutOfBoundsException.php',
        'Wingu\\OctopusCore\\Reflection\\Annotation\\Exceptions\\RuntimeException' => __DIR__ . '/..' . '/wingu/reflection/src/Annotation/Exceptions/RuntimeException.php',
        'Wingu\\OctopusCore\\Reflection\\Annotation\\Parser' => __DIR__ . '/..' . '/wingu/reflection/src/Annotation/Parser.php',
        'Wingu\\OctopusCore\\Reflection\\Annotation\\TagMapper' => __DIR__ . '/..' . '/wingu/reflection/src/Annotation/TagMapper.php',
        'Wingu\\OctopusCore\\Reflection\\Annotation\\Tags\\BaseTag' => __DIR__ . '/..' . '/wingu/reflection/src/Annotation/Tags/BaseTag.php',
        'Wingu\\OctopusCore\\Reflection\\Annotation\\Tags\\ParamTag' => __DIR__ . '/..' . '/wingu/reflection/src/Annotation/Tags/ParamTag.php',
        'Wingu\\OctopusCore\\Reflection\\Annotation\\Tags\\ReturnTag' => __DIR__ . '/..' . '/wingu/reflection/src/Annotation/Tags/ReturnTag.php',
        'Wingu\\OctopusCore\\Reflection\\Annotation\\Tags\\TagInterface' => __DIR__ . '/..' . '/wingu/reflection/src/Annotation/Tags/TagInterface.php',
        'Wingu\\OctopusCore\\Reflection\\Annotation\\Tags\\VarTag' => __DIR__ . '/..' . '/wingu/reflection/src/Annotation/Tags/VarTag.php',
        'Wingu\\OctopusCore\\Reflection\\Exceptions\\Exception' => __DIR__ . '/..' . '/wingu/reflection/src/Exceptions/Exception.php',
        'Wingu\\OctopusCore\\Reflection\\Exceptions\\InvalidArgumentException' => __DIR__ . '/..' . '/wingu/reflection/src/Exceptions/InvalidArgumentException.php',
        'Wingu\\OctopusCore\\Reflection\\Exceptions\\RuntimeException' => __DIR__ . '/..' . '/wingu/reflection/src/Exceptions/RuntimeException.php',
        'Wingu\\OctopusCore\\Reflection\\ReflectionClass' => __DIR__ . '/..' . '/wingu/reflection/src/ReflectionClass.php',
        'Wingu\\OctopusCore\\Reflection\\ReflectionClassUse' => __DIR__ . '/..' . '/wingu/reflection/src/ReflectionClassUse.php',
        'Wingu\\OctopusCore\\Reflection\\ReflectionConstant' => __DIR__ . '/..' . '/wingu/reflection/src/ReflectionConstant.php',
        'Wingu\\OctopusCore\\Reflection\\ReflectionDocComment' => __DIR__ . '/..' . '/wingu/reflection/src/ReflectionDocComment.php',
        'Wingu\\OctopusCore\\Reflection\\ReflectionDocCommentTrait' => __DIR__ . '/..' . '/wingu/reflection/src/ReflectionDocCommentTrait.php',
        'Wingu\\OctopusCore\\Reflection\\ReflectionExtension' => __DIR__ . '/..' . '/wingu/reflection/src/ReflectionExtension.php',
        'Wingu\\OctopusCore\\Reflection\\ReflectionFile' => __DIR__ . '/..' . '/wingu/reflection/src/ReflectionFile.php',
        'Wingu\\OctopusCore\\Reflection\\ReflectionFunction' => __DIR__ . '/..' . '/wingu/reflection/src/ReflectionFunction.php',
        'Wingu\\OctopusCore\\Reflection\\ReflectionMethod' => __DIR__ . '/..' . '/wingu/reflection/src/ReflectionMethod.php',
        'Wingu\\OctopusCore\\Reflection\\ReflectionObject' => __DIR__ . '/..' . '/wingu/reflection/src/ReflectionObject.php',
        'Wingu\\OctopusCore\\Reflection\\ReflectionParameter' => __DIR__ . '/..' . '/wingu/reflection/src/ReflectionParameter.php',
        'Wingu\\OctopusCore\\Reflection\\ReflectionProperty' => __DIR__ . '/..' . '/wingu/reflection/src/ReflectionProperty.php',
        'Wsdl2PhpGenerator\\ArrayType' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/src/ArrayType.php',
        'Wsdl2PhpGenerator\\ClassGenerator' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/src/ClassGenerator.php',
        'Wsdl2PhpGenerator\\ComplexType' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/src/ComplexType.php',
        'Wsdl2PhpGenerator\\Config' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/src/Config.php',
        'Wsdl2PhpGenerator\\ConfigInterface' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/src/ConfigInterface.php',
        'Wsdl2PhpGenerator\\Enum' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/src/Enum.php',
        'Wsdl2PhpGenerator\\Filter\\DefaultFilter' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/src/Filter/DefaultFilter.php',
        'Wsdl2PhpGenerator\\Filter\\FilterFactory' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/src/Filter/FilterFactory.php',
        'Wsdl2PhpGenerator\\Filter\\FilterInterface' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/src/Filter/FilterInterface.php',
        'Wsdl2PhpGenerator\\Filter\\ServiceOperationFilter' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/src/Filter/ServiceOperationFilter.php',
        'Wsdl2PhpGenerator\\Generator' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/src/Generator.php',
        'Wsdl2PhpGenerator\\GeneratorInterface' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/src/GeneratorInterface.php',
        'Wsdl2PhpGenerator\\Operation' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/src/Operation.php',
        'Wsdl2PhpGenerator\\OutputManager' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/src/OutputManager.php',
        'Wsdl2PhpGenerator\\Pattern' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/src/Pattern.php',
        'Wsdl2PhpGenerator\\PhpSource\\PhpClass' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/lib/PhpSource/PhpClass.php',
        'Wsdl2PhpGenerator\\PhpSource\\PhpDocComment' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/lib/PhpSource/PhpDocComment.php',
        'Wsdl2PhpGenerator\\PhpSource\\PhpDocElement' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/lib/PhpSource/PhpDocElement.php',
        'Wsdl2PhpGenerator\\PhpSource\\PhpDocElementFactory' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/lib/PhpSource/PhpDocElementFactory.php',
        'Wsdl2PhpGenerator\\PhpSource\\PhpElement' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/lib/PhpSource/PhpElement.php',
        'Wsdl2PhpGenerator\\PhpSource\\PhpFile' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/lib/PhpSource/PhpFile.php',
        'Wsdl2PhpGenerator\\PhpSource\\PhpFunction' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/lib/PhpSource/PhpFunction.php',
        'Wsdl2PhpGenerator\\PhpSource\\PhpVariable' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/lib/PhpSource/PhpVariable.php',
        'Wsdl2PhpGenerator\\Service' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/src/Service.php',
        'Wsdl2PhpGenerator\\StreamContextFactory' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/src/StreamContextFactory.php',
        'Wsdl2PhpGenerator\\Type' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/src/Type.php',
        'Wsdl2PhpGenerator\\Validator' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/src/Validator.php',
        'Wsdl2PhpGenerator\\Variable' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/src/Variable.php',
        'Wsdl2PhpGenerator\\Xml\\DocumentedNode' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/src/Xml/DocumentedNode.php',
        'Wsdl2PhpGenerator\\Xml\\OperationNode' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/src/Xml/OperationNode.php',
        'Wsdl2PhpGenerator\\Xml\\SchemaDocument' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/src/Xml/SchemaDocument.php',
        'Wsdl2PhpGenerator\\Xml\\ServiceNode' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/src/Xml/ServiceNode.php',
        'Wsdl2PhpGenerator\\Xml\\TypeNode' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/src/Xml/TypeNode.php',
        'Wsdl2PhpGenerator\\Xml\\WsdlDocument' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/src/Xml/WsdlDocument.php',
        'Wsdl2PhpGenerator\\Xml\\XmlNode' => __DIR__ . '/..' . '/wsdl2phpgenerator/wsdl2phpgenerator/src/Xml/XmlNode.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit15308d529b25ba8f236f28b6c4365e3c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit15308d529b25ba8f236f28b6c4365e3c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit15308d529b25ba8f236f28b6c4365e3c::$classMap;

        }, null, ClassLoader::class);
    }
}
