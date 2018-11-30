<?php
namespace FormBuilder;

use \OCFram\FormBuilder;
use \OCFram\StringField;
use \OCFram\TextField;
use \OCFram\UploadFileField;
use \OCFram\MaxLengthValidator;
use \OCFram\NotNullValidator;
use \OCFram\ExtensionValidator;
use \OCFram\SizeValidator;
use \OCFram\HiddenField;

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
        'size' => 50,
        'validators' => [
          new MaxLengthValidator('Le titre spécifié est trop long (100 caractères maximum)', 100),
          new NotNullValidator('Merci de spécifier le titre du chapitre'),
        ],
       ]))
        ->add(new HiddenField([
        
        'name' => 'nameImage',
       
        
       ]))
         ->add(new UploadFileField([
        'label' => 'Image:',
        'name' => 'image',
        'enctype' => 'multipart/from-data',
        'size' => 4000000,
        'type' => 'file',
        'validators' => [
         new ExtensionValidator('ce n est pas une extention Valide', ['.jpg','.png','.bmp']),
         new SizeValidator('Le fichier est trop gros',4000),
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
       ]))
        ;
  }
}
