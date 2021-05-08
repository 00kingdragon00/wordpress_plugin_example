import classnames from "classnames";
import block_icons from "../icons/index";
import btn_icon from "./icon";
import "./editor.scss";

const { registerBlockType } = wp.blocks;
const { __ } = wp.i18n;
const { BlockControls, InspectorControls } = wp.editor;
const { ToolbarGroup, ToolbarButton, Tooltip, PanelBody, PanelRow, FormToggle } = wp.components;
registerBlockType("test/night-mode", {
  title: __("Night Mode", "recipe"),
  description: __("Content with night mode.", "recipe"),
  category: "common",
  icon: block_icons.wapuu,
  attributes: {
    night_mode: {
      type: "boolean",
      default: false,
    },
  },
  edit: (props) => {
    const toggleNightMode = () => {
      props.setAttributes({ night_mode: !props.attributes.night_mode });
    };
    return [
      <InspectorControls>
        <PanelBody title={__("Night Mode", "recipe")}>
          <PanelRow>
              <label htmlFor="test-recipe-night-mode">{__('Night Mode', 'recipe')}</label>
            <FormToggle
              id="test-recipe-night-mode"
              checked={props.attributes.night_mode}
              onChange={toggleNightMode}
            ></FormToggle>
          </PanelRow>
        </PanelBody>
      </InspectorControls>,
      <div className={props.className}>
        <BlockControls>
          <ToolbarGroup>
            <Tooltip text={__("Night Mode", "recipe")}>
              <ToolbarButton
                className={classnames("component-icon-button", "component-toolbar__control", {
                  "is-active": props.attributes.night_mode,
                })}
                onClick={toggleNightMode}
              >
                {btn_icon}
              </ToolbarButton>
            </Tooltip>
          </ToolbarGroup>
        </BlockControls>
        <div className={classnames("content-example", { night: props.attributes.night_mode })}>
          This is an example of a block with night mode.
        </div>
      </div>,
    ];
  },
  save: (props) => {
    return (
      <div>
        <div className={classnames("content-example", { night: props.attributes.night_mode })}>
          This is an example of a block with night mode.
        </div>
      </div>
    );
  },
});
