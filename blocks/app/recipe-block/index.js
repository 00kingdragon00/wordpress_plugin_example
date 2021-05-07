// wp.
const { registerBlockType } = wp.blocks;
const { __ } = wp.i18n;
const { InspectorControls } = wp.editor;
const { PanelBody, PanelRow, TextControl, SelectControl } = wp.components;

import block_icons from "../icons";

registerBlockType("test/recipe", {
  title: __("Recipe", "recipe"),
  description: __("Provides a short summary of a recipe", "recipe"),
  category: "common",
  icon: block_icons.wapuu,
  keywords: [__("Food", "recipe"), __("Ingredients", "recipe"), __("Meal Type", "recipe")],
  supports: {
    html: false,
    align: true,
    customClassName: false,
  },
  attributes: {
    ingredients: {
      source: "text",
    },
    cooking_time: {
      source: "text",
    },
    utensils: {
      source: "text",
    },
    cooking_experience: {
      source: "text",
      default: "Beginner",
    },
    meal_type: {
      source: "text",
      default: "Dinner",
    },
  },
  edit: (props) => {
    return [
      <InspectorControls>
        <PanelBody title={__("Basic", "recipe")}>
          <PanelRow>
            <p>{__("Configure the contents of your block here", "recipe")}</p>
          </PanelRow>

          <TextControl
            Label={__("Ingredients", "recipe")}
            help={__("Ex: tomatoes, olive oil, cheese, etc.", "recipe")}
            value={props.attributes.ingredients}
            onChange={(new_val) => {
              props.setAttributes({ ingredients: new_val });
            }}
          ></TextControl>

          <TextControl
            Label={__("Cooking Time", "recipe")}
            help={__("How long will this take to cook?", "recipe")}
            value={props.attributes.cooking_time}
            onChange={(new_val) => {
              props.setAttributes({ cooking_time: new_val });
            }}
          ></TextControl>

          <TextControl
            Label={__("Utensils", "recipe")}
            help={__("Ex: Pan, Cooker etc.", "recipe")}
            value={props.attributes.utensils}
            onChange={(new_val) => {
              props.setAttributes({ utensils: new_val });
            }}
          ></TextControl>

          <SelectControl
            Label={__("Cooking Experience", "recipe")}
            help={__("How skilled should the reader be?")}
            options={[
              { value: "Beginner", label: "Beginner" },
              { value: "Intermediate", label: "Intermediate" },
              { value: "Expert", label: "Expert" },
            ]}
            value={props.attributes.cooking_experience}
            onChange={(new_val) => {
              props.setAttributes({ cooking_experience: new_val });
            }}
          ></SelectControl>

          <SelectControl
            Label={__("Meal Type", "recipe")}
            help={__("When is this best eaten")}
            options={[
              { value: "Breakfast", label: "Breakfast" },
              { value: "Lunch", label: "Lunch" },
              { value: "Dinner", label: "Dinner" },
            ]}
            value={props.attributes.meal_type}
            onChange={(new_val) => {
              props.setAttributes({ meal_type: new_val });
            }}
          ></SelectControl>
        </PanelBody>
      </InspectorControls>,
      <div className={props.className}>
        <ul class="list-unstyled">
          <li>
            <strong>{__("Ingredients:", "recipe")}</strong> {props.attributes.ingredients}
          </li>
          <li>
            <strong>{__("Cooking Time:", "recipe")} </strong> {props.attributes.cooking_time}
          </li>
          <li>
            <strong>{__("Utensils:", "recipe")} </strong> {props.attributes.utensils}
          </li>
          <li>
            <strong>{__("Cooking Experience:", "recipe")} </strong>{" "}
            {props.attributes.cooking_experience}
          </li>
          <li>
            <strong>{__("Meal Type:", "recipe")} </strong> {props.attributes.meal_type}
          </li>
        </ul>
      </div>,
    ];
  },
  save: (props) => {
    return <p>Hello World</p>;
  },
});
