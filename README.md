**Deep Relations in Laravel: Handling Course-Episode Relationships**

In Laravel, you often deal with relationships that span multiple tables. Here's a quick guide to counting related data through deep relations:

**Option 1: Using `hasManyThrough`**

When you store a direct reference like `course_id` in the `episodes` table, you can establish a deep relation using `hasManyThrough`. This is perfect for counting through intermediate relationships.

```php
// file: Topic.php
public function episodes()
{
    return $this->hasManyThrough(Episode::class, Course::class);
}
```

```php
// file: 2024_05_01_095831_create_episodes_table
Schema::create('episodes', function (Blueprint $table) {
    $table->id();
    $table->foreignId('course_id')->constrained()->onDelete('cascade');
    $table->foreignId('section_id')->constrained()->onDelete('cascade');
    // other fields...
});
```

**Option 2: Using `hasManyDeep`**

If you prefer not to add `course_id` to the `episodes` table, the `staudenmeir/eloquent-has-many-deep` package allows you to traverse deep relationships without direct references.

```php
// Required package: composer require staudenmeir/eloquent-has-many-deep

// file: Topic.php
use HasRelationships; // Import this for 'hasManyDeep'

public function episodes()
{
    return $this->hasManyDeep(Episode::class, [Course::class, Section::class]);
}
```

With these setups, you can fetch data along with relationship counts in one go:

```php
// Retrieve topics with counts of associated courses and episodes
Topic::withCount(['courses', 'episodes'])->get();
```

This fetches all topics and adds the count of related courses and episodes, enabling you to manage deep relationships efficiently.
