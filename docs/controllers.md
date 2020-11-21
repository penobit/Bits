## Penobit Micro Framework Documentation
### Controllers:

Include in your index.php (front controller) all your controllers files then just add some Actions.

#### Using Restful Actions on Books
```php
// $id_book will be the value passed on the URL
// file: src/controllers/main.php

//create
$app->post('/books/',function() use ($app){
     $handler = new BookHandler();
     $book = $handler->create( $app->getRequest() );
     
     return $app->Response('view.php',array('book' => $book),201);
});

$app->get('/books/{id_book}/',function($id_book) use ($app){
     $handler = new BookHandler();
     $book = $handler->get($id_book);
     
     return $app->Response('view.php',array('book' => $book));
});

$app->put('/books/{id_book}/',function($id_book) use ($app){
     $handler = new BookHandler();
     $book = $handler->update($id_book,$app->getRequest());
     
     return $app->Response('view.php',array('book' => $book));
});

$app->delete('/books/{id_book}/',function($id_book) use ($app){
     $handler = new BookHandler();
     $res = $handler->delete($id_book);
     
     return $app->Response('view.php',array('deleted' => $res));
});

```

### Next: [Views ](https://github.com/penobit/PenoLite/blob/master/docs/views.md "Render views from controllers with One Framework")


##### This documentation is served in [Penobit](http://penobit.com/penolite/docs/ "More documentation of the Penobit")
###### Contribute and improve this documentation.
###### Click Edit and Fork the project.
