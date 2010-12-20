<?php
$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'About',
);
?>
<h1>About</h1>

<p>An application for writing multi-part documents.</p>  

<p>This application is Free Software.</p>

<h2>What this software is for...</h2>

<p>The basic idea behind this software is the generation and management of encapsulated text fragments.  Large documents are often composed in one large chunk of text (obviously with paragraph, section and chapter breaks), while this is useful for keeping everything in one place and maintaining a narrative it can be sub-optimal for dealing with the generation of large Academic texts that have less emphasis on maintaining a clear causal order within the document.  The nature of Academic work is such that parts of the documents produced are closely related (e.g. by reference) to parts distant from themselves.  This application intends to provide a way to encapsulate segments of text so that they can be repositioned easily within a document.  As such using this application will require a slightly different approach to drafting a document than simply typing continuously within a word processor.  The separation of segments of writing into stand alone groups is designed to allow documents to be radically reordered without worry about the sense changing, in order to greatly facilitate editing a document.</p>

<p>A secondary goal of the software is to allow authors to specify a broad outline of a document by defining sections (and sections within sections) which can then be fleshed out, without a commitment to the structure of the broad outline being the final structure of the resulting document.  A further extrapolation of this idea is to allow relationships between both sections and texts and to allow views which make use of these relations.  For example I might know that there is an argument from Section 2 Text 4 in combination with Section 4 Text 1 to support Section 5.  The software will allow these relations to be represented and further for just this argument to be pulled out and viewed in isolation.</p>

<h2>How to use this software...</h2>

<p>The basic level at which most work will be done is that of the Text.  A Text is a collection of words that can be anything from a single paragraph* to a whole section of a dissertation.  The hallmark of a Text is that it encapsulates a communication act that can stand alone without context**.  The author may arrange one or more Texts into a Section.  A Section is intended to be used in much the same way as a section is used in an Academic document, to delineate a specific area of discussion.  Sections can be nested to create a chapter structure (etc.).  Top Level Sections may then be assigned to a Document.</p>

<h2>Software roadmap</h2>


<h2>Footnotes</h2>
<ol type='*'>
	<li> A Text can theoretically be a single word but in practical terms when rendering out a document it will be wrapped in a paragraph delimiter, thus multiple Texts cannot be rolled into one coherent line of text.</li>
	<li> Obviously some context within a document is required, I mean that the Text is in fact separated out from its immediate predecessor in a document.  For instance, "Another reason we might believe ..." would not be an appropriate start to a Text.</li>
</ol>
