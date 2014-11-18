<?php

namespace spec\ReadmeGen\Vcs\Type;

use PhpSpec\ObjectBehavior;
use ReadmeGen\Shell;
use ReadmeGen\Vcs\Type\Git;

class GitSpec extends ObjectBehavior
{
    
    function it_should_parse_a_git_log(Shell $shell)
    {
        $log = sprintf("Foo bar.%s\nDummy message.%s\n\n", Git::MSG_SEPARATOR, Git::MSG_SEPARATOR);
        $shell->run(sprintf('git log --pretty=format:"%%s%s%%b"', Git::MSG_SEPARATOR))->willReturn($log);
        
        $this->setShellRunner($shell);
        
        $this->parse()->shouldReturn(array(
            'Foo bar.',
            'Dummy message.',
        ));
    }
    
    function it_has_input_options_and_arguments()
    {
        $this->setOptions(array('a'));
        $this->setArguments(array('foo' => 'bar'));
        
        $this->hasOption('z')->shouldReturn(false);
        $this->hasOption('a')->shouldReturn(true);
        
        $this->hasArgument('wat')->shouldReturn(false);
        $this->hasArgument('foo')->shouldReturn(true);
        $this->getArgument('foo')->shouldReturn('bar');
    }
    
}
