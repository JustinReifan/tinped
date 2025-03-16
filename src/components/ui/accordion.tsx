
import * as React from "react"
import * as AccordionPrimitive from "@radix-ui/react-accordion"
import { ChevronDown, Plus, Minus } from "lucide-react"

import { cn } from "@/lib/utils"

const Accordion = AccordionPrimitive.Root

const AccordionItem = React.forwardRef<
  React.ElementRef<typeof AccordionPrimitive.Item>,
  React.ComponentPropsWithoutRef<typeof AccordionPrimitive.Item>
>(({ className, ...props }, ref) => (
  <AccordionPrimitive.Item
    ref={ref}
    className={cn("tw-border-b", className)}
    {...props}
  />
))
AccordionItem.displayName = "AccordionItem"

const AccordionTrigger = React.forwardRef<
  React.ElementRef<typeof AccordionPrimitive.Trigger>,
  React.ComponentPropsWithoutRef<typeof AccordionPrimitive.Trigger>
>(({ className, children, ...props }, ref) => (
  <AccordionPrimitive.Header className="tw-flex">
    <AccordionPrimitive.Trigger
      ref={ref}
      className={cn(
        "tw-flex tw-flex-1 tw-items-center tw-justify-between tw-py-4 tw-font-medium tw-transition-all tw-duration-300 hover:tw-underline [&[data-state=open]>svg.plus]:tw-hidden [&[data-state=open]>svg.minus]:tw-block [&[data-state=closed]>svg.plus]:tw-block [&[data-state=closed]>svg.minus]:tw-hidden",
        className
      )}
      {...props}
    >
      {children}
      <Plus className="tw-h-5 tw-w-5 tw-shrink-0 tw-text-primary-400 plus tw-transition-transform tw-duration-300" />
      <Minus className="tw-h-5 tw-w-5 tw-shrink-0 tw-text-primary-500 minus tw-hidden tw-transition-transform tw-duration-300" />
    </AccordionPrimitive.Trigger>
  </AccordionPrimitive.Header>
))
AccordionTrigger.displayName = AccordionPrimitive.Trigger.displayName

const AccordionContent = React.forwardRef<
  React.ElementRef<typeof AccordionPrimitive.Content>,
  React.ComponentPropsWithoutRef<typeof AccordionPrimitive.Content>
>(({ className, children, ...props }, ref) => (
  <AccordionPrimitive.Content
    ref={ref}
    className="tw-overflow-hidden tw-text-sm tw-transition-all tw-duration-300 data-[state=closed]:tw-animate-accordion-up data-[state=open]:tw-animate-accordion-down"
    {...props}
  >
    <div className={cn("tw-pb-4 tw-pt-0", className)}>{children}</div>
  </AccordionPrimitive.Content>
))

AccordionContent.displayName = AccordionPrimitive.Content.displayName

export { Accordion, AccordionItem, AccordionTrigger, AccordionContent }
