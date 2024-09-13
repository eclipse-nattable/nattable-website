---
title: "NatTable Feature Overview"
date: 2024-01-01T00:00:00-00:00
summary: "A compact overview of the Nebula NatTable features"
---

This is a overview of features of the NatTable widget. We also recommend 
to try out the [NatTable Examples Application]({{< ref "../examples" >}}).
For detail and technical insight please look at the 
[NatTable - Documentation](https://github.com/eclipse-nattable/nattable/wiki).

Please note that most feature are optional, they can be enabled or disabled
when constructing the table widget.

## Table, tree and special layouts
In addition to the classic table layout, NatTable also supports:
* Trees supporting expand/collapse of rows
* Cells spanning multiple rows and columns
* Dynamically changing table layouts

## Low requirements
* Simple interface to hook in the data model
* Cell values are only loaded if required e.g. for painting

This allows NatTable to handle huge datasets from nearly any source without any performance issues.

## Custom / Conditional Styling
It is possible to completely adjust the styling of each cell.

{{< figure src="featuresScreenshot_PercentageBar.png" caption="Completely customizable rendering: Percentage Bars" alt="Screenshot percentage bars">}}

## UI Binding
* Customizable converters between actual data value and rendered value
* Configurable cell painters allow complete control over cell rendering
* Bind feature to arbitrary key / mouse triggers

## Flexible Selection
NatTable uses a flexible selection model which tracks the selection by rows, columns and indiviual cells.
* Predefined keyboard and mouse actions
* Optional JFace selection provider

## Editing
* Cell editors for common data types (text, combo and check box)
* Configurable validation rules
* Visual indication of invalid values
* Multi-cell editing allows changing multiple cell values at once

## Grouping and Freezing of Rows and Columns
* Row groups and column groups
* Multiple grouping levels
* Collapse/Expand of groups
* Freezing of column and rows avoids scrolling of selected cells

## Sorting, Filtering and Searching
* Sorting by column (up/down/of) with indicator in headers
* Sorting by multiple columns
* Custom comparators per column possible
* Filtering by values in columns
* Searching values in table (dialog)

## Cell highlighting
* Blinking cell
* E.g. for changed cell or your own criteria

## Column/Row customization

* Resize and auto-size of rows and columns (by mouse)
* Multi row/column resize, so all selected rows/columns are resized to the same size
* Reorder and hide/show of columns (by mouse and dialog)
* Group/ungroup of columns
* Rename of columns
* Configure cell format of columns
NatTable provides a lot of predefined actions which allows the user to customize the table:

{{< figure src="featuresScreenshot_ColumnChooser.png" caption="Column chooser: quickly change order and visibility">}}

## Persistence
A NatTable can save and restore its configuration e.g. column groups, group states, cell formats.

## Standard Actions
Standard action implementations to:
* Copy data to clipboard (Ctrl + C)
* Export as Excel file (formatting preserved, Ctrl + E)
* Print (formatting preserved, Ctrl + P)