run parser by following command

php parser.php example_1.csv combination_count.csv

example_1.csv is an input file
combination_count.csv is an output combination file

In settings.php, we can change mappings and sequence of columns in output file
```

$headingMappings = [];
$headingMappings["brand_name"] = ["make", 0];
$headingMappings["model_name"] = ["model", 1];
$headingMappings["colour_name"] = ["colour", 2];
$headingMappings["gb_spec_name"] = ["capacity", 3];
$headingMappings["network_name"] = ["network", 4];
$headingMappings["grade_name"] = ["grade", 5];
$headingMappings["condition_name"] = ["condition", 6];
```
In above mapping object first argument indicates the destination column name and second argument indicates the position of column in output file.
In this way, change in column name of output file, input file and it's respective position can be managed.

Code is done in a way that it handles memory, as it reads one row from csv file and do not manage a specific array for parsed csv output.


