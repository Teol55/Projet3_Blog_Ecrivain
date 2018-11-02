<?php
namespace FormBuilder;

use \OCFram\FormBuilder;
use \OCFram\StringField;
use \OCFram\TextField;
use \OCFram\MaxLengthValidator;
use \OCFram\NotNullValidator;

class NewsFormBuilder extends FormBuilder
{
  public function build()
  {
    $this->form->add(new StringField([
        'label' => 'Chapitre :',
        'name' => 'chapitre',
        'maxLength' => 20,
        'validators' => [
          new MaxLengthValidator('Le Chapitre spécifié est trop long (20 caractères maximum)', 20),
 new NotNullValidator('Merci de spécifier le chapitre du roman'),
        ],
       ]))
       ->add(new StringField([
        'label' => 'Titre: ',
        'name' => 'titre',
        'maxLength' => 100,
        'validators' => [
          new MaxLengthValidator('Le titre spécifié est trop long (100 caractères maximum)', 100),
          new NotNullValidator('Merci de spécifier le titre du chapitre'),
        ],
       ]))
       ->add(new TextField([
        'label' => 'Contenu',
        'classe'=>'mytextarea',
        'name' => 'contenu',
        'rows' => 8,
        'cols' => 60,
        'validators' => [
          new NotNullValidator('Merci de spécifier le contenu du chpitre'),
        ],
       ]));
  }
}
