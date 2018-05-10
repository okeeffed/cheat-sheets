# Design Systems

[Style Guides Website](http://styleguides.io/examples.html)

<!-- TOC -->

*   [Design Systems](#design-systems)
    *   [From the podcast](#from-the-podcast)
    *   [Design System Links](#design-system-links)
    *   [Carbon Design System](#carbon-design-system)
        *   [Guidelines](#guidelines)
            *   [Accessibility](#accessibility)
            *   [Content](#content)
            *   [Principles](#principles)
        *   [Style](#style)
        *   [Components](#components)
    *   [A11y Style Guide](#a11y-style-guide)
    *   [Material Design](#material-design)
        *   [Colour](#colour)
        *   [Patterns](#patterns)
        *   [Growth & communications](#growth--communications)
        *   [Platforms](#platforms)
    *   [viljamisdesign.com](#viljamisdesigncom)
    *   [Atlassian design](#atlassian-design)
    *   [Dropbox Branding](#dropbox-branding)
    *   [Government Guidelines](#government-guidelines)
    *   [Microservices](#microservices)
        *   [Logging](#logging)
    *   [Coding](#coding)
        *   [Concerning factors](#concerning-factors)
    *   [Workplace Best Practises](#workplace-best-practises)
    *   [Mathemetic Concepts](#mathemetic-concepts)
    *   [Inspiration](#inspiration)

<!-- /TOC -->

## From the podcast

1.  IBM Carbon
2.  Animation - following important preset guidelines or enforcing something flexible to deal with brand identity
    1.  Easing timings
    2.  Bezier curves
3.  Having a company set structure for their own “Bootstrap” or “Material UI”
    1.  Structure being something that can be documented or readily altered

## Design System Links

[Carbon Design System](http://carbondesignsystem.com/)

## Carbon Design System

Consists of a few major sections: `Guidelines`, `Style`, `Components`, `Resources` and `Component Status`.

### Guidelines

#### Accessibility

Carbon shows emphasis on using the `tabindex` correctly and allowing a `Skip to content` option when there is lengthy navigation so a user may access main content faster.

An example of a personal, basic implementation can be found over at the [blog for Qantas](https://www.qantasnewsroom.com.au/).

#### Content

Conversation levels for Carbon have been established with examples to portay a tone reflective of the company values. What is the difference between voice and tone? As IBM puts it:

`Simply put, we have the same voice all the time, but our tone often changes. Consider this: You have one voice, but you most likely use a certain tone when you are having coffee with friends and a different tone when you are meeting with your boss.`

Tense and sentence structure have continued to haunt me since high school English, but thankfully we now have well thought out and refactored methods and examples to help us out.

#### Principles

1.  Be essential
2.  Be inclusive
3.  Be consistent
4.  Be humanistic
5.  Be delightful

### Style

The style section gives an overview of the standard colours, grids, iconography, typography and motion. Each section provides video examples and even copy options where relavent (colours as an example of a hover that allows you to copy the hex on a click).

### Components

The components section gives examples of implmentation and shows images of the buttons in different states.

## A11y Style Guide

When it comes to accessibility, your goto reference must be the [A11y style guide](http://a11y-style-guide.com/style-guide/).

The structure is broken down into the following:

0.  Overview
1.  Forms
1.  General
1.  Media
1.  Navigation
1.  Structure
1.  Resources

For anyone who has had the pleasure of writing forms in HTML, this style guide is worth its weight in gold.

It also contains more information on implementing `skip links`.

One line worth considering in your mantra comes from the base of the `media` section: `Build your media with accessibility in mind! It is much easier to work accessibility into the beginning than trying to tack it on later.`. Can I get an hallelujah?

Worthy notes on videos is to offer a transcript or alternative audio track to allow users the option to read or listen to the video.

## Material Design

[Google's Material Design](https://material.io/guidelines/material-design/introduction.html).

One of the stronger points of this style guide is coverage of devices and screen sizes it keeps reference too. The `motion` section (a personal favourite) is pletiful with useful gems.

The guide puts an emphasis on `larger screens` vs `tablets` vs `wearables` vs `mobile` devices, something I hadn't even considered prior to reading through their `motion` section.

The choreography section itself has many elegant examples that guide you through their principles in practise - something even someone like myself, a layperson to the great church of animation, can appreciate.

### Colour

Material Design even has an [incredible palette available](https://material.io/color/) to help you with deciding upon colour schemes.

### Patterns

The section I am most impressed with is the `Patterns` section. This section itself places an emphasis on employing healthy, regulated design patterns to put into practise.

### Growth & communications

Another section seen sparingly across style guides is a section that details customer-application communications. A simple use case applicable to all application builders is an onboarding process, and explains three onboarding models that are accepted and when and when not to employ a particular model.

### Platforms

The `Platforms` section of this style guide also gives insight to platform adaption.

## viljamisdesign.com

Viljami Salminen is a Finnish product designer. A personal ode to his own design guidelines [viljamisdesign.com](https://viljamisdesign.com/styleguide/). Whereas most style guides on this list are highly regulated and continually improved naturally over time through corporate implementation, having a reference to a personally written style guide echoes an individual's mantra. This is both a great way to convey to clients the culmination of your own style and experience.

## Atlassian design

[Atlassian design](https://atlassian.design/).

Hot off the heels of their new AUD$10 billion dollar valued office in Sydney CBD and during the beta of their latest iteration of their product line, this is a great chance for you to watch Atlassian push their design practise from staging to production. The guide holds many similiar stables in the concept of writing style and foundations, but a great addition to their guide is a section to inform good practise on `presentations`, a necessary skill if you ever plan on wooing a room full of people.

## Dropbox Branding

[Dropbox Brading](https://www.dropbox.com/branding/)

*   Screenshots and press releases
*   Application icons

## Government Guidelines

[UK](https://www.gov.uk/guidance/style-guide)
[USA](https://standards.usa.gov/)

## Microservices

### Logging

[Artcile from Rising Stack](https://blog.risingstack.com/distributed-tracing-opentracing-node-js/)

## Coding

*   [Data Structures](https://medium.freecodecamp.org/10-common-data-structures-explained-with-videos-exercises-aaff6c06fb2b)
*   [The Basic Principles of Visual Design](https://blog.prototypr.io/10-basic-principles-of-visual-design-55b86b9f7241)
*   [Creating Usability With Motion](https://medium.com/ux-in-motion/creating-usability-with-motion-the-ux-in-motion-manifesto-a87a4584ddc)
*   [12 Steps for Software-as-a-Service apps](https://12factor.net/)
*   [RSCSS](http://rscss.io/)

### Concerning factors

1.  Keeping processes as stateless `processes are stateless and share-nothing` and require a `backing service` to deal with this.
2.  [Logging](https://logmatic.io/blog/beyond-application-monitoring-discover-logging-best-practices/)
3.  [Response status codes](https://httpstatuses.com/)
4.  Network Configuration
    *   [VPC Best Practises](http://blog.flux7.com/blogs/aws/vpc-best-configuration-practices)
5.  Typography
    *   [Typography Handbook](http://typographyhandbook.com/)

## Workplace Best Practises

1.  Password storage
2.  Communication within the team
3.  [Agile Methodology and Retrospectives](https://www.atlassian.com/agile)
4.  Continuous Integration, Contiunous Delivery and Continuous Deployment
    *   [Electric Cloud on continuous integration](http://electric-cloud.com/plugins/continuous-integration/)
    *   [Assembla Blog on CI vs CD](https://blog.assembla.com/assemblablog/tabid/12618/bid/92411/continuous-delivery-vs-continuous-deployment-vs-continuous-integration-wait-huh.aspx)
    *   [Atlassian](https://www.atlassian.com/continuous-delivery/ci-vs-ci-vs-cd)
5.  Feedback
6.  Client relations
7.  [API Design Standards](https://softwareengineeringdaily.com/2017/04/05/api-design-standards-with-andy-beier/)
8.  [Berkerley Citations](http://guides.lib.berkeley.edu/citation_management)

## Mathemetic Concepts

*   [Graph Theory](https://www.youtube.com/watch?v=HmQR8Xy9DeM)

## Inspiration

*   [Hi Five Bro](http://www.highfivebro.com/)
