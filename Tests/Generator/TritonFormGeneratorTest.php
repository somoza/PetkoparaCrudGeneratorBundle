<?php

/*
 * This file is part of the CrudGeneratorBundle
 *
 * It is based/extended from SensioGeneratorBundle
 *
 * (c) Petko Petkov <petkopara@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Petkopara\TritonCrudBundle\Tests\Generator;

use Petkopara\TritonCrudBundle\Generator\TritonFormGenerator;
use Sensio\Bundle\GeneratorBundle\Tests\Generator\GeneratorTest;

class TritonFormGeneratorTest extends GeneratorTest {

    public function testGenerate() {
        /*
        $this->generateForm(false);
        $this->assertTrue(file_exists($this->tmpDir . '/Form/PostType.php'));
        $content = file_get_contents($this->tmpDir . '/Form/PostType.php');
        $this->assertContains('->add(\'title\')', $content);
        $this->assertContains('->add(\'createdAt\')', $content);
        $this->assertContains('->add(\'publishedAt\')', $content);
        $this->assertContains('->add(\'updatedAt\')', $content);
        $this->assertContains('class PostType extends AbstractType', $content);
        $this->assertContains("'data_class' => 'Foo\BarBundle\Entity\Post'", $content);
        if (!method_exists('Symfony\Component\Form\AbstractType', 'getBlockPrefix')) {
            $this->assertContains('getName', $content);
            $this->assertContains("'foo_barbundle_post'", $content);
        } else {
            $this->assertNotContains('getName', $content);
            $this->assertNotContains("'foo_barbundle_post'", $content);
        }
        */
    }
    
    
    private function generateForm($overwrite)
    {
        $generator = new TritonFormGenerator($this->filesystem);
        $generator->setSkeletonDirs(__DIR__.'/../../Resources/skeleton');
        $bundle = $this->getMockBuilder('Symfony\Component\HttpKernel\Bundle\BundleInterface')->getMock();
        $bundle->expects($this->any())->method('getPath')->will($this->returnValue($this->tmpDir));
        $bundle->expects($this->any())->method('getNamespace')->will($this->returnValue('Foo\BarBundle'));
        $metadata = $this->getMockBuilder('Doctrine\ORM\Mapping\ClassMetadataInfo')->disableOriginalConstructor()->getMock();
        $metadata->identifier = array('id');
        $metadata->fieldMappings = array(
            'title' => array('type' => 'string'),
            'createdAt' => array('type' => 'date'),
            'publishedAt' => array('type' => 'time'),
            'updatedAt' => array('type' => 'datetime'),
        );
        $metadata->associationMappings = $metadata->fieldMappings;
        $generator->generate($bundle, 'Post', $metadata, $overwrite);
    }

}
