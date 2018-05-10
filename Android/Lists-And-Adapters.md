# Lists and Adapters in Android

**What is an adapter?**

If we have our data and a list view, we can then use an adapter to adapt data for the view.

Android provides a number of different adapters.

Example with the `ArrayAdapter`, it is an extension of the `BaseAdapter`.

Declaring a string adapter would be `ArrayAdapter<String>` that can deal with generic types. We specify the type within the angle brackets.

```java
package teamtreehouse.com.stormy.ui;

import ...

static class DailyForecastActivity extends ListActivity {
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_daily_forecast);

		String[] daysOfTheWeek = {
			"Sunday",
			"Monday",
			...
		}
		ArrayAdapter<String> adapter = new ArrayAdapter<String>(this, android.R.layout.simple_list_item_1,
			daysOfTheWeek);

		setListAdapter(adapter);
	}
}
```
