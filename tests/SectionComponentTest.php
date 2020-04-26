<?php


use Formz\View\Components\Section;
use Formz\Contracts\IForm;
use Formz\Contracts\ISection;
use Illuminate\Support\Collection;

class SectionComponentTest extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return ['Formz\FormzServiceProvider'];
    }

    /** @test */
    public function a_section_component_has_a_collection_of_fields()
    {
        $sectionComponent = new Section($this->mockSection());

        $this->assertInstanceOf(Collection::class, $sectionComponent->fields());
        $this->assertEquals(2, $sectionComponent->fields()->count());
    }




    private function mockSection()
    {
        $section = Mockery::mock(ISection::class);

        $section->shouldReceive('getContext')
            ->andReturn($this->mockForm());
        $section->shouldReceive('getFields')
            ->andReturn(collect(['field1', 'field2']));

        return $section;
    }

    private function mockForm()
    {
        $form = Mockery::mock(IForm::class);
        $form->shouldReceive('getTheme')
            ->andReturn('bootstrap4');
        return $form;
    }
}
