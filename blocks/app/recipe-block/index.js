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
            value="test"
            onChange={(new_val) => {
              console.log(new_val);
            }}
          ></TextControl>

          <TextControl
            Label={__("Cooking Time", "recipe")}
            help={__("How long will this take to cook?", "recipe")}
            value="test"
            onChange={(new_val) => {
              console.log(new_val);
            }}
          ></TextControl>

          <TextControl
            Label={__("Utensils", "recipe")}
            help={__("Ex: Pan, Cooker etc.", "recipe")}
            value="test"
            onChange={(new_val) => {
              console.log(new_val);
            }}
          ></TextControl>

          <SelectControl
            Label={__("Cooking Experience", "recipe")}
            help={__("How skilled should the reader be?")}
            value="Beginner"
            options={[
              { value: "Beginner", label: "Beginner" },
              { value: "Intermediate", label: "Intermediate" },
              { value: "Expert", label: "Expert" },
            ]}
            onChange={(new_val) => {
              console.log(new_val);
            }}
          ></SelectControl>

          <SelectControl
            Label={__("Meal Type", "recipe")}
            help={__("When is this best eaten")}
            value="Dinner"
            options={[
              { value: "Breakfast", label: "Breakfast" },
              { value: "Lunch", label: "Lunch" },
              { value: "Dinner", label: "Dinner" },
            ]}
            onChange={(new_val) => {
              console.log(new_val);
            }}
          ></SelectControl>
        </PanelBody>
      </InspectorControls>,
      <div className={props.className}>
        <ul class="list-unstyled">
          <li>
            <strong>{__("Ingredients:", "recipe")}</strong> INGREDIENTS_PH
          </li>
          <li>
            <strong>{__("Cooking Time:", "recipe")} </strong> COOKING_TIME_PH
          </li>
          <li>
            <strong>{__("Utensils:", "recipe")} </strong> UTENSILS_PH
          </li>
          <li>
            <strong>{__("Cooking Experience:", "recipe")} </strong> LEVEL_PH
          </li>
          <li>
            <strong>{__("Meal Type:", "recipe")} </strong> TYPE_PH
          </li>
        </ul>
      </div>,
    ];
  },
  save: (props) => {
    return <p>Hello World</p>;
  },
});
