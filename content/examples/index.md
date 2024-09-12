---
title: "NatTable Examples Application"
date: 2024-01-01T00:00:00-00:00
summary: "Download the NatTable Examples Application"
---

The NatTable Examples Application is a good starting point to get familiar with NatTable.
It contains multiple examples to show the features and how to configure them.

{{< figure src="nattable_examples.png" caption="NatTable Examples Application" alt="NatTable Examples Application">}}

It can be downloaded in different variants:

| JAR                                                                                                                                                                             | Windows x86_64                                                                                                                                                                                                                                    | Mac OS                                                                                                                                                                                                                                            | Linux GTK                                                                                                                                                                                                                                      |
| ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| {{< figure src="Java.png" width="50px" height="50px" link="http://www.eclipse.org/downloads/download.php?file=/nattable/releases/2.4.0/NatTableExamples.jar" target="_blank">}} | {{< figure src="OS_Windows_8.png" width="50px" height="50px" link="http://www.eclipse.org/downloads/download.php?file=/nattable/releases/2.4.0/org.eclipse.nebula.widgets.nattable.examples.e4.product-win32.win32.x86_64.zip" target="_blank">}} | {{< figure src="OS_Apple.png" width="50px" height="50px" link="http://www.eclipse.org/downloads/download.php?file=/nattable/releases/2.4.0/org.eclipse.nebula.widgets.nattable.examples.e4.product-macosx.cocoa.x86_64.tar.gz" target="_blank">}} | {{< figure src="OS_Linux.png" width="50px" height="50px" link="http://www.eclipse.org/downloads/download.php?file=/nattable/releases/2.4.0/org.eclipse.nebula.widgets.nattable.examples.e4.product-linux.gtk.x86_64.tar.gz" target="_blank">}} |

The JAR version is the old plain SWT version of the NatTable examples application. It contains all required libraries except the SWT library. To run the plain SWT version of the examples application you need to download the JAR from here and the SWT library for your operating system from the <a href="http://download.eclipse.org/eclipse/downloads/" target="_blank">Eclipse download page</a>.

For links to the stable SWT Binary and Source for all platforms, select the entry for the latest official release and then scroll to bottom of page.

After you have downloaded the NatTable Examples JAR and the SWT JAR for your platform and placed them together in the same directory, the examples can be started with the following command from the command line:

```
java -cp swt.jar;NatTableExamples.jar org.eclipse.nebula.widgets.nattable.examples.NatTableExamples
```

The downloads provided for different operating systems are Eclipse 4 RCP applications. To run these you only need to download, unpack and start the executable. Note that these versions also contain the E4 examples, which are not included in the plain SWT JAR.