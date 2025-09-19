---
title: "NatTable 2.6.0 - New & Noteworthy"
date: 2025-09-19T00:00:00-00:00
summary: "Nebula NatTable 2.6.0 released"
categories: ["news"]
---

The NatTable 2.6.0 release was made possible by several companies that provided and sponsored ideas, bug reports, discussions and new features you can find in the following sections. We would like to thank everyone involved for their commitment and support on developing the 2.6.0 release.

We would especially like to thank [Robotron Datenbank-Software GmbH](https://www.robotron.de/) for sponsoring the NatTable RAP implementation.

Of course we would also like to thank our contributors for adding new functions and fixing issues.

Almost every change in code is tracked via [GitHub Issues](https://github.com/eclipse-nattable/nattable/milestone/5?closed=1), so if you are curious about the details and all the bugs that are fixed and enhancements that were added with the 2.6.0 release, have a look there.

### API changes

The following modifications to the API were made. Several new classes and interfaces were introduced to support new features. The details can be found in the _Enhancements and new features_ section.

Below is the list of new classes and interfaces

* `org.eclipse.nebula.widgets.nattable.Activator` in `org.eclipse.nebula.widgets.nattable.core`
* `org.eclipse.nebula.widgets.nattable.util.PlatformHelper`
* `org.eclipse.nebula.widgets.nattable.groupby.GroupByCommand`
* `org.eclipse.nebula.widgets.nattable.extension.glazedlists.groupBy.command.GroupByCommandHandler`
* `org.eclipse.nebula.widgets.nattable.extension.glazedlists.groupBy.SortModelGroupByComparator`

Below is the list of new constructors

* `ScalingMouseWheelListener(boolean)`
* `ScalingMouseWheelListener(boolean, Consumer<IConfigRegistry>)`
* `ScalingUiBindingConfiguration(NatTable, boolean)`
* `ScalingUiBindingConfiguration(NatTable, boolean, Consumer<IConfigRegistry>)`
* `ZoomInScalingAction(boolean)`
* `ZoomInScalingAction(boolean, Consumer<IConfigRegistry>)`
* `ZoomOutScalingAction(boolean)`
* `ZoomOutScalingAction(boolean, Consumer<IConfigRegistry>)`
* `SliderScroller(Slider, boolean)`
* `NatExporter(Shell, boolean, boolean, boolean, Runnable)`
* `ExportCommand(IConfigRegistry, Shell, boolean, boolean, ILayerExporter, boolean, Runnable)`

Below is the list of new constants

* `GridRegion#GROUP_BY_REGION`

Below is the list of new fields

* `NatExporter#successRunnable` (private)

Below is the list of new methods

* `ExportCommand#isOpenResult()`
* `ExportCommand#getSuccessRunnable()`
* `NatExporter#setSuccessRunnable(Runnable)`
* `GroupModel#isVisible()`
* `HoverLayer#isColumnPositionHovered(int)`
* `HoverLayer#isRowPositionHovered(int)`
* `HoverLayer#isFireColumnUpdates()`
* `HoverLayer#setFireColumnUpdates(boolean)`
* `HoverLayer#isFireRowUpdates()`
* `HoverLayer#setFireRowUpdates(boolean)`
* `ScalingUtil#zoomIn(NatTable, boolean, Consumer<IConfigRegistry>)`
* `ScalingUtil#zoomOut(NatTable, boolean, Consumer<IConfigRegistry>)`
* `ScalingUtil#getNewZoomInDPI(int, boolean)`
* `ScalingUtil#getNewZoomOutDPI(int, boolean)`
* `ViewportLayer#getHorizontalScroller()`
* `ViewportLayer#getVerticalScroller()`

### Dependency Updates

We updated the dependencies to consume the latest versions of third-party-libraries provided by Eclipse Orbit. Additionally we updated to the latest [Nebula Release 3.2.0](https://github.com/EclipseNebula/nebula/releases/tag/V3.2.0) which forces an update of the Target Platform to Eclipse 2024-06 (4.32) because of a dependency of `CDateTime` to SWT >= 3.126.0. The dependency update mainly influences the NatTable E4 Extension and the NatTable Nebula Extension, which now require Java 17 because of the transitive dependencies. NatTable Core, the NatTable GlazedLists Extension and the NatTable POI Extension still only require Java 11 and also still work with older Eclipse releases.

Additionally the NatTable update site does now not contain the third-party-libraries itself, as they can be automatically be resolved via p2. The NatTable features now also don't specify any requirements anymore, as the requirements are defined on a bundle level. This makes the NatTable update site smaller and easier to be integrated in user setups, e.g. if new versions of a dependency needs to be consumed.

### Enhancements and new features

*   **RAP Support**  
    
    It is now possible to use NatTable with RAP. For this several modifications needed to be done in the NatTable Core, to avoid issues when running with RAP. A detailed description about those modifications can be found in the [corresponding pull request](https://github.com/eclipse-nattable/nattable/pull/146).

    To support NatTable in RAP the newly introduced NatTable RAP fragment needs to be added to the runtime. The fragment uses [Byte Buddy](https://github.com/raphw/byte-buddy) to inject the necessary RAP features to NatTable. This is necessary because `NatTable` is based on `Canvas`, but we need a specialized `CanvasOperationHandler` to get everything working in NatTable. This is especially necessary for the mouse interactions and the scrolling. A detailed description on the details of the fragment can be found in the [NatTable RAP GitHub Repository](https://github.com/eclipse-nattable/nattable-rap).

    {{< figure src="nattable_examples_rap.png" alt="NatTable Examples RAP Application">}}

*   **Axis Hover**  
    
    It is now possible to configure a NatTable to highlight the whole column and/or the whole row when hovering over a cell. To be able to highlight a whole column and/or row, the `HoverLayer` needs to be configured to fire the corresponding update events:

    ```java
    hoverLayer.setFireRowUpdates(true);
    hoverLayer.setFireColumnUpdates(true);
    ```
    
    The `IConfigLabelAccumulator` on the `HoverLayer`then needs to be implemented so it inspects that information:

    ```java
    hoverLayer.setConfigLabelAccumulator(new IConfigLabelAccumulator() {

        @Override
        public void accumulateConfigLabels(LabelStack configLabels, int columnPosition, int rowPosition) {
            boolean rowHover = hoverLayer.isFireRowUpdates() && hoverLayer.isRowPositionHovered(rowPosition);
            boolean columnHover = hoverLayer.isFireColumnUpdates() && hoverLayer.isColumnPositionHovered(columnPosition);
            if (rowHover || columnHover) {
                configLabels.add(AXIS_HOVER_LABEL);
            }
        }
    });
    ```

    We added the [_5066_GridBodyAxisHoverStylingExample](https://github.com/eclipse-nattable/nattable/blob/master/org.eclipse.nebula.widgets.nattable.examples/src/org/eclipse/nebula/widgets/nattable/examples/_500_Layers/_506_Hover/_5066_GridBodyAxisHoverStylingExample.java) to show the configuration of the axis hover.

    {{< figure src="axis_hover_styling.png" alt="GridBodyAxisHoverStylingExample">}}

* **Dynamic scaling in percentage mode**  

    The dynamic scaling in NatTable by default scales according to OS scaling levels. The main reason for this is the scaling of icons that are provided in different OS scaling levels.

    To enable zoom operations with smaller steps, you need to add the `ScalingUiBindingConfiguration` like this:
    ```java
    natTable.addConfiguration(new ScalingUiBindingConfiguration(natTable, true));
    ```

    The percentage configuration will increase/decrease generally by 10%, and will use one of the predefined OS scalings in case the calculated DPI are "near" the OS scaling value.    

* **Configure a success action with the `ExportCommand`**

    It is now possible to configure the action that should be triggered when an export operation finishes successfully. The typical action is to open the generated export file using `org.eclipse.swt.program.Program`. This is for example not possible in RAP. To support a _generate and download_ scenario in RAP and inform the user once a export succeeded, it is now possible to configure a success `Runnable` when triggering an export.

    ```java
    natTable.doCommand(
            new ExportCommand(
                    natTable.getConfigRegistry(),
                    natTable.getShell(),
                    false,
                    false,
                    null,
                    false,
                    () -> {
                        MessageDialog.openInformation(
                                natTable.getShell(),
                                "Export Succeeded",
                                "The export finished successfully");
                    }));
    ```


* **Improvements to programmatic groupBy**

    To support the groupby feature without a direct dependency to the GlazedLists Extension, the `GridRegion#GROUP_BY_REGION` and the `org.eclipse.nebula.widgets.nattable.groupby.GroupByCommand` were added to the NatTable Core. The command and the implementation of `org.eclipse.nebula.widgets.nattable.extension.glazedlists.groupBy.command.GroupByCommandHandler` in the GlazedLists Extension supports extended ways to set a groupby in a more extended way, e.g. grouping multiple columns.

* **Alternative `GroupByComparator`**

    A new `SortModelGroupByComparator` was added to improve scenarios when sorting a table with active groupBy states. It primarily uses the `ISortModel` to sort the list by values, and the `GroupByObject`s in second place. This changes the behavior when sorting a table with active groupby in that way, that the groupby tree structure could also update when sorting a column that is used for grouping.

    ```java
    SortModelGroupByComparator<ExtendedPersonWithAddress> groupByComparator = new SortModelGroupByComparator<>(
            bodyLayerStack.getGroupByModel(),
            columnPropertyAccessor,
            bodyLayerStack.getBodyDataLayer());
    bodyLayerStack.getBodyDataLayer().setComparator(groupByComparator);

    // connect sortModel to SortModelGroupByComparator to support sorting by
    // group by summary values
    groupByComparator.setSortModel(sortHeaderLayer.getSortModel());
    ```

    The [`_808_SortableGroupByWithFilterExample`](https://github.com/eclipse-nattable/nattable/blob/master/org.eclipse.nebula.widgets.nattable.examples/src/org/eclipse/nebula/widgets/nattable/examples/_800_Integration/_808_SortableGroupByWithFilterExample.java) was updated to show the usage and behavior of that new `GroupByComparator`.
