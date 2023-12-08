# PowerJoins in LaraGrid

PowerJoins is a Laravel package that provides an easy way to join related tables in an Eloquent query. It is used in LaraGrid to handle complex queries involving related models.

In LaraGrid, PowerJoins is used in the `BaseLaraGrid` class, specifically in the `render` method. This method is responsible for building the query for the grid's data source, including applying filters and sorting. When a column's model field contains a dot (.), indicating a relation, PowerJoins is used to join the related table to the query.

The `orderByLeftPowerJoins` method from PowerJoins is used to sort the grid's data based on a related model's field. This method takes two arguments: the related model's field and the sort direction. It automatically joins the related table to the query and sorts the data based on the specified field and direction.

PowerJoins also provides a `whereHasPowerJoins` method, which is used to apply filters to the grid's data based on a related model's field. This method takes a closure that receives a query builder instance and defines the conditions for the filter.

In summary, PowerJoins is used in LaraGrid to handle complex queries involving related models. It provides an easy way to join related tables, sort data based on a related model's field, and apply filters based on a related model's field.