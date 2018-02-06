# Simple Model Filtering
This is a simple model filtering for laravel

## Getting Started
Copy the trait in your src (or in the folder that you prefered) and change the placeholder namespace with the right one.

## Include the Trait in your model classes
Use the in your model or in your base model, e.g:
```
use NamespaceToTrait\Filterable;

class BaseModel extends Model
{
    use Filterable;
}
```

## Add in your model class the columns sortable
```
class Model extends BaseModel
{
    protected $filterableColumns = ['name', 'email'];
    ...
}
```

## Use the new scope in your sortable queries
```
return Model::filterable()->paginate(10);
```

## Frontend 
Append these get params in a route with filterable scope:

f (filterable) = Here populate with the name of the column (required) <br>
q (query) = Here populate with the query (required) <br>
o (operator) = Here populate with the acronym of the operator (optional, default l [like])
```
?f=name&q=Michele&o=e
```

## Available Operators

l = like <br>
e = equals <br>
d = different <br>
m = major <br>
me = major or equals <br>
mi = minor <br>
mie = minor or equals <br>
