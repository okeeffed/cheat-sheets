# iOS Cheat Sheet

# Dates and Time

## Check if the time is between two hours

```objective-c
-(void)checkTimeFrame
{
  NSDateComponents *components = [[NSCalendar currentCalendar] components:NSHourCalendarUnit | NSMinuteCalendarUnit | NSSecondCalendarUnit fromDate:[NSDate date]];
  NSInteger currentHour = [components hour];

  if (currentHour < 9 && currentHour > 3) {
    // Do Something
    NSLog(@"In between the times");
    NSLog(@"%ld\n", (long)currentHour);
  } else {
    NSLog(@"Not between the times");
    NSLog(@"%ld\n", (long)currentHour);
  }
}
```

# UISearchBar

## Target Search Bar after load

```objective-c
-(void)viewDidAppear:(BOOL)animated
{
  [self.searchBar becomeFirstResponder];
}
```
