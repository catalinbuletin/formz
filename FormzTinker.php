<?php
$form = \Formz\Form::make()
  ->addFields([
  	\Formz\Field::text('firstName', 'First Name')->required()
  ]);

  
$form = \Formz\Form::make()->addFields([
  	\Formz\Field::text('first_name', 'First name', 'Catalin')->required()->w1p2(),
  	\Formz\Field::text('last_name', 'Last name', 'Buletin')->required()->w1p2(),
	\Formz\Field::radio('gender', ['m' => 'M', 'f' => 'F'], 'Gender')->required()->displayInline(),
  	\Formz\Field::text('email', 'E-mail')->rules(['required', 'email']),
  	\Formz\Field::text('status', 'Status')->readonly(),
    \Formz\Field::text('some_id', 'Some id')->hidden(),
  	\Formz\Field::text('game', 'Favourite Game')->rules(['min:3', 'max:24', 'alpha'])->workflows([
    	\Formz\Workflow::showIf('gender', '=', 'M')
    ]),
  	\Formz\Field::text('magazine', 'Favourite Magazine')->rules([
      	\Formz\Rules::min('3'),
      	\Formz\Rules::max('34'),
    	\Formz\Rules::alpha(),
    ])->workflows([
    	\Formz\Workflow::showIf('gender', '=', 'F')
    ]),
]);

class RegistrationForm extends \Formz\Form
{
 	public function __construct()
    {
     	$this->section()
          ->text('name', 'Name', ['required', 'min:3'])
          ->radio('gender', ['m' => 'M', 'f' => 'F'], 'Gender', ['required'])
          ->radio(
          	   \Formz\Field::radio('gender', ['m' => 'M', 'f' => 'F'], 'Gender')->required()->displayInline()
          	)
          ->text('username', 'Username', ['required', 'unique:users'])
          ->select('interests', fn(\App\Interests $interests) => $interests->active())
          ->field(\Formz\Field::password('password')->rules(['required', 'confirmed'])->w1p2())
          ->field(\Formz\Field::password('password_confirm')->required()->w1p2())
        ;
      
      	$this->section()->name('Lorem ipsum')->addFields([
        	\Formz\Field::text('first_name', 'First name', 'Catalin')->required()->w1p2(),
          	\Formz\Field::text('last_name', 'Last name', 'Buletin')->required()->w1p2(),
          	\Formz\Field::radio('gender', ['m' => 'M', 'f' => 'F'], 'Gender')->required()->displayInline(),
          	\Formz\Field::text('email', 'E-mail')->rules(['required', 'email']),
        ]);
    }
  
}
 echo json_encode($form);


// $form = \Formz\Form::make()->addFields([
//   	\Formz\Field::text('first_name', 'First name', 'Catalin')->required()->w1p2(),
//   	\Formz\Field::text('last_name', 'Last name', 'Buletin')->required()->w1p2(),
// 	\Formz\Field::radio('gender', \Formz\Options::yesNo(), 'Gender')->required(),
//   	\Formz\Field::text('email', 'E-mail')->required(),
//   	\Formz\Field::text('game', 'Favourite Game')->rules([
//       	new \Formz\Rules\MinLength('3'),
//       	new \Formz\Rules\MaxLength('34'),
//     	new \Formz\Rules\Alpha(),  
//     ])->workflows([
//     	\Formz\Workflow::showIf('gender', '=', 'M')
//     ]),
//   	\Formz\Field::text('magazine', 'Favourite Magazine')->rules([
//       	new \Formz\Rules\MinLength('3'),
//       	new \Formz\Rules\MaxLength('34'),
//     	new \Formz\Rules\Alpha(),
//     ])->workflows([
//     	\Formz\Workflow::showIf('gender', '=', 'F')
//     ]),
// ]);

// Formz\Form::make()
//   ->addSection('Personal details', [
//     	Formz\Field::text('first_name', 'First name', 'Catalin')->required()->w1p2(),
//       	Formz\Field::text('last_name', 'Last name', 'Buletin')->required()->w1p2(),
//     	Formz\Field::email('email', 'E-mail')->placeholder('example@email.com')->required(),
//     	Formz\Field::radio('gender', 'Gender', ['M' => 'Male', 'F' => 'Female'])->required(),
//     ])
//   ->addSection('Interests', [
//       Formz\Field::text('game', 'Favourite Game')->rules([
//           Formz\Rule::min('3'),
//           Formz\Rule::max('24'),
//           Formz\Rule::requiredIf('gender', '=', 'M'),  
//       ])->workflows([
//           Formz\Workflow::showIf('gender', '=', 'M')
//       ]),
//       Formz\Field::text('magazine', 'Favourite Magazine')->rules([
//           Formz\Rule::min('3'),
//           Formz\Rule::max('24'),
//           Formz\Rule::requiredIf('gender', '=', 'F')
//       ])->workflows([
//           Formz\Workflow::showIf('gender', '=', 'F')
//       ]),
//   ]);

// Formz::create();