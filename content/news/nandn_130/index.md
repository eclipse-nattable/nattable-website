---
title: "NatTable 1.3.0 - New & Noteworthy"
date: 2015-03-28T00:00:00-00:00
summary: "Nebula NatTable 1.3.0 released"
categories: ["news"]
---

The NatTable 1.3.0 release is intended to be a bugfix release. It contains mainly bugfixes and just small enhancements requested by the community in order to make the NatTable API more extensible.

Almost every change in code is tracked via ticket in Bugzilla, so if you are curious about the details and all the bugs that are fixed and enhancements that were added with the 1.3.0 release, have a look [here](https://bugs.eclipse.org/bugs/buglist.cgi?classification=Technology&list_id=8836815&product=NatTable&query_format=advanced&resolution=FIXED&target_milestone=1.3.0).

### API changes

*   Introduced the `ICalculatedValueCache` interface and added corresponding getter and setter on `SummaryRowLayer` and `GroupByDataLayer` in order to be able to exchange the implementation for caching calculated values.
*   Added `AbstractTextPainter#setTrimText(boolean)` to be able to configure if the text that is rendered by an `AbstractTextPainter` is trimmed or not.
*   Reworked column reordering in combination with column grouping. This caused the introduction of several new command handler and the modification of several existing command handler related to column reordering. The update of column groups on column reordering is now performed in `ColumnGroupReorderLayer#updateColumnGroupModel()`.
*   Changed visibility of `ColumnResizeDragMode#getColumnWidthMinimum()` to `protected` in order to support specifying a custom min width for columns on drag resizing.

### Enhancements and new features

*   Replaced every occurence of `SWT.CTRL` in the NatTable default bindings with `SWT.MOD1` to make the bindings work correctly on Mac OS.
*   Introduced the usage of an API Baseline and using the API tooling in order to ensure to have correct versions regarding the OSGi semantic versioning.