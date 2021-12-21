# Introduction

Logger Manager for the Merophp Framework. The manager holds PSR-3-based named loggers, so you can easily connect 
logging libraries or custom loggers to the framework.

## Installation

Via composer:

<code>
composer install merophp/log-manager
</code>

## Basic Usage

<pre><code>use Merophp\LogManager\LogManager;
use Merophp\LogManager\namedLogger\AbstractNamedLogger;

require_once dirname(__DIR__).'/vendor/autoload.php';

class MyLogger extends AbstractNamedLogger
{
    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
$logManager = new LogManager;
$logManager->addLogger(new MyLogger('security');

$logManager->warning('security', 'My message');
$logManager->getLogger('security')->warning('My message');
</code></pre>
